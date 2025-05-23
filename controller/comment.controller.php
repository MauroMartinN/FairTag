<?php

require_once '../model/entidades/Comment.php';
require_once '../model/CommentDAO.php';
require_once '../model/PostDAO.php';
require_once '../model/notificacionDAO.php';
require_once '../model/denunciaDAO.php';
require_once '../model/entidades/denuncia.php';

class CommentController {

    private $model;

    public function __construct() {
        $this->model = new CommentDAO();
    }

    public function crear($post_id) {
        require_once '../view/comment/create.php';
    }

    public function guardar() {
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] == 2) {
            header("Location: index.php?c=User&a=perfil&v=ok");
            exit();
        }
        if ($_POST) {
            $comment = new Comment();
            $comment->setContent($_POST['content']);
            $comment->setUserId($_POST['user_id']);
            $comment->setPostId($_POST['post_id']);
            $comment->setCreatedAt(date('Y-m-d H:i:s'));
            $this->model->guardar($comment);

            $postDAO = new PostDAO();
            $post = $postDAO->obtenerPorId($comment->getPostId());

            if ($post) {
                $notification = new Notificacion();
                $notification->setUserId($post->getUserId());
                $notification->setPostId($post->getId());
                $notification->setIsRead(false);
                $notification->setMessage("Nuevo comentario en tu post: " . substr($comment->getContent(), 0, 50) . "...");

                $notificationDAO = new NotificacionDAO();
                $notificationDAO->guardar($notification);
            }

            header("Location: index.php?c=Post&a=ver&id=" . $comment->getPostId());
            exit();
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $commentId = intval($_POST['id']);
            $postId = intval($_POST['post_id']);
            $this->model->eliminar($commentId);
            header("Location: index.php?c=Post&a=ver&id=$postId");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }

    public function denunciar() {
        $usuarioId = $_SESSION['user_id'];
        $comentarioId = $_POST['comentario_id'];
        $motivo = $_POST['motivo'];
        $postId = $_POST['post_id'];

        $denuncia = new Denuncia();
        $denuncia->setContenidoId($comentarioId);
        $denuncia->setUsuarioId($usuarioId);
        $denuncia->setTipo('comentario');
        $denuncia->setMotivo($motivo);
        $denuncia->setFecha(date('Y-m-d H:i:s'));

        $dao = new DenunciaDAO();
        $dao->guardar($denuncia);

        header("Location: index.php?c=post&a=ver&id=".$postId);
        exit;
    }

    public function listarPorUserId() {
        $userId = $_GET['id'];
        $comments = $this->model->obtenerPorUserId($userId);
        require_once '../view/header.php';
        require_once '../view/dashboard/listaComments.php';
        require_once '../view/footer.php';
    }

    public function ver() {
        if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1) {
            if (isset($_GET['id'])) {
                $comment = $this->model->obtenerPorId($_GET['id']);
                require_once '../view/header.php';
                require_once '../view/comment/ver.php';
                require_once '../view/footer.php';
            } else {
                header("Location: index.php?c=Denuncia&a=listarDenuncias");
                exit();
            }
        }
        else {
            header("Location: index.php");
            exit();
        }
    }

}
