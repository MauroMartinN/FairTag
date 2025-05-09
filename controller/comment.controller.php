<?php

require_once '../model/entidades/Comment.php';
require_once '../model/CommentDAO.php';

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
            header("Location: index.php?c=Post&a=ver&id=" . $comment->getPostId());
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminar($_GET['id']);
            header("Location: index.php?c=Post&a=ver&id=" . $_GET['post_id']);
        }
    }
}
