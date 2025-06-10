<?php

require_once '../model/entidades/post.php';
require_once '../model/postDAO.php';
require_once '../model/paisDAO.php';
require_once '../model/commentDAO.php';
require_once '../model/userDAO.php';
require_once '../model/denunciaDAO.php';
require_once '../model/tipo_postDAO.php';
require_once '../services/fetchCountry.php';


class PostController
{
    private $model;

    public function __construct()
    {
        $this->model = new PostDAO();
    }

    public function index()
    {
        $posts = $this->model->obtenerTodos();
        $userDAO = new UserDAO();

        require_once '../view/header.php';
        require_once '../view/post/posts.php';
        require_once '../view/footer.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $userDAO = new UserDAO();
            $yaEsFavorito = $userDAO->yaEsFavorito($_SESSION['user_id'], $_GET['id']);

            $post = $this->model->obtenerPorId($_GET['id']);
            $postId = $post->getId();
            $userId = $post->getUserId();

            $user = $userDAO->obtenerPorId($userId);
            $autor = $user->getName();

            $commentDao = new CommentDAO();
            $comments = $commentDao->obtenerPorPostId($post->getId());

            require_once '../view/header.php';
            require_once '../view/post/ver.php';

            include '../view/comment/lista.php';
            if (isset($_SESSION['user_id'])) {
                include '../view/comment/crear.php';
            }

            require_once '../view/footer.php';
        } else {
            header("Location: index.php?c=Pais&a=index");
        }
    }

    public function crear()
    {
        $tiposDAO = new TipoPostDAO();

        $tipos = $tiposDAO->getAll();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=User&a=login");
            return;
        }
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] == 2) {
            header("Location: index.php?c=User&a=perfil&v=ok");
            return;
        }
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 1)
                $mensaje = "El enlace de Google Maps no es válido.";
            else if ($error == 2)
                $mensaje = "Ya hay un post en esas cordenadas.";
            else if ($error == 3)
                $mensaje = "La imagen debe ser menor a 2MB.";
        }

        $pais = $_GET['pais'];
        require_once '../view/header.php';
        require_once '../view/post/crear.php';
        require_once '../view/footer.php';
    }

    public function guardar()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] == 2) {
            header("Location: index.php?c=User&a=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $googleLink = $_POST['google_link'];
            $coordenadas = $this->extraerCoordenadasDesdeLink($googleLink);
            $latitude = $coordenadas['latitude'];
            $longitude = $coordenadas['longitude'];
            $pais = fetchCountryFromCoordinates($latitude, $longitude);

            if (!$latitude || !$longitude || !$pais) {
                header("Location: index.php?c=Post&a=crear&error=1");
                exit();
            }

            if ($this->model->obtenerPostPorCoordinadas($latitude, $longitude)) {
                header("Location: index.php?c=Post&a=crear&error=2");
                exit();
            }

            if ($_FILES['image']['error'] == 1) {
                header("Location: index.php?c=Post&a=crear&error=3");
                exit();
            }

            $paisDao = new PaisDAO();
            $paisId = $paisDao->obtenerPorNombre($pais);
            $paisId = $paisId->getId();

            $post = new Post();
            $post->setTitle($_POST['title']);
            $post->setContent($_POST['content']);
            $post->setImage($_FILES['image']['name']);
            $post->setGoogleLink($googleLink);
            $post->setUserId($_SESSION['user_id']);
            $post->setCreatedAt(date('Y-m-d'));
            $post->setLatitude($latitude);
            $post->setLongitude($longitude);
            $post->setCountry($paisId);
            $post->setType($_POST['type']);

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $uniqueName = uniqid('img_', true) . '.' . $ext;
            $uploadPath = 'postsImg/' . $uniqueName;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

            $post->setImage($uniqueName);
            $this->model->guardar($post);
            header("Location: index.php?c=Pais&a=ver&lat=" . $latitude . "&lon=" . $longitude . "&pais=" . $pais);
            exit();
        }
    }

    public function eliminar()
    {
        $postId = $_POST['id'];
        $post = $this->model->obtenerPorId($postId);
        if (!$post) {
            header("Location: index.php?c=Pais&a=index");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $rolId = $_SESSION['rol_id'];
        if ($rolId == 1 || ($rolId == 3 && $post->getUserId() == $userId)) {
            $postImage = $post->getImage();
            unlink('postsImg/' . $postImage);
            $this->model->eliminar($postId);
            header("Location: index.php?c=user&a=perfilPosts");
            exit();
        } else {
            header("Location: index.php?c=Pais&a=index");
            exit();
        }
    }

    public function denunciar()
    {
        $usuarioId = $_SESSION['user_id'];
        $motivo = $_POST['motivo'];
        $postId = $_POST['post_id'];

        if (!isset($usuarioId) || !isset($motivo) || !isset($postId)) {
            header("Location: index.php?c=Post&a=ver&id=" . $postId);
            exit();
        }

        $denuncia = new Denuncia();
        $denuncia->setContenidoId($postId);
        $denuncia->setUsuarioId($usuarioId);
        $denuncia->setTipo('post');
        $denuncia->setMotivo($motivo);
        $denuncia->setFecha(date('Y-m-d H:i:s'));

        $dao = new DenunciaDAO();
        $dao->guardar($denuncia);

        header("Location: index.php?c=post&a=ver&id=" . $postId);
        exit();
    }

    public function listarPorUserId()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: index.php?c=Home&a=index");
            exit;
        }
        $userId = $_GET['id'];
        $posts = $this->model->obtenerPorUsuarioId($userId);
        require_once '../view/header.php';
        require_once '../view/dashboard/listaPosts.php';
        require_once '../view/footer.php';
    }

    private function extraerCoordenadasDesdeLink($google_link)
    {
        $partes = explode('!3d', $google_link);

        if (isset($partes[1])) {
            $coords1 = explode('!4d', $partes[1]);
            $coords2 = explode('!', $coords1[1] ?? '');

            if (isset($coords1[0], $coords2[0])) {
                return [
                    'latitude' => $coords1[0],
                    'longitude' => $coords2[0]
                ];
            }
        }

        return [
            'latitude' => null,
            'longitude' => null
        ];
    }
}