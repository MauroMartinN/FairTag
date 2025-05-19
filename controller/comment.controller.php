<?php

require_once '../model/entidades/Comment.php';
require_once '../model/CommentDAO.php';
require_once '../model/PostDAO.php';
require_once '../model/notificacionDAO.php';
require_once '../model/denunciaComentarioDAO.php';
require_once '../model/entidades/denunciaComentario.php';

class CommentController {

    private $model;

    public function __construct() {
        $this->model = new CommentDAO();
    }

    public function crear($post_id) {
        require_once '../view/comment/create.php';
    }

    public function guardar() {
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
        if (isset($_GET['id'])) {
            $this->model->eliminar($_GET['id']);
            header("Location: index.php?c=Post&a=ver&id=" . $_GET['post_id']);
            exit();
        }
    }

    public function denunciar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentarioId = $_POST['comentario_id'];
            $usuarioId = $_SESSION['user_id'];
            $motivo = $_POST['motivo'];

            $denuncia = new DenunciaComentario();
            $denuncia->setComentarioId($comentarioId);
            $denuncia->setUsuarioId($usuarioId);
            $denuncia->setMotivo($motivo);
            $denuncia->setFecha(date('Y-m-d H:i:s'));

            $dao = new DenunciaComentarioDAO();
            $dao->guardar($denuncia);

            header("Location: index.php?c=Post&a=ver&id=" . $_POST['post_id']);
            exit;
        }
    }
}
