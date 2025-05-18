<?php

require_once '../model/entidades/post.php';
require_once '../model/postDAO.php';
require_once '../model/commentDAO.php';
require_once '../model/userDAO.php';

class PostController {
    private $model;

    public function __construct() {
        $this->model = new PostDAO();
    }

    public function index() {
        $posts = $this->model->obtenerTodos();
        $userDAO = new UserDAO();
        
        require_once '../view/header.php';
        require_once '../view/post/posts.php';
        require_once '../view/footer.php';
    }

    public function ver() {
        if (isset($_GET['id'])) {
            $post = $this->model->obtenerPorId($_GET['id']);
            $postId = $post->getId();
            $userId = $post->getUserId();

            $userDAO = new UserDAO();
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
            header("Location: index.php?c=Post&a=index");
        }
    }

    public function crear() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=User&a=login");
            return;
        }


        require_once '../view/header.php';
        require_once '../view/post/crear.php';
        require_once '../view/footer.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = new Post();
            $post->setTitle($_POST['title']);
            $post->setContent($_POST['content']);
            $post->setImage($_FILES['image']['name']);
            $post->setGoogleLink($_POST['google_link']);
            $post->setUserId($_SESSION['user_id']); 
            $post->setCreatedAt(date('Y-m-d'));
            $post->setType($_POST['type']);

            move_uploaded_file($_FILES['image']['tmp_name'], 'postsImg/' . $_FILES['image']['name']);

            $this->model->guardar($post);
            header("Location: index.php?c=Post&a=index");
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminar($_GET['id']);
            header("Location: index.php?c=Post&a=index");
        }
    }
}