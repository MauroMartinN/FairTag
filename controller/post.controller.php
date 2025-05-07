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
        
        require_once '../view/header.php';
        require_once '../view/post/posts.php';
        require_once '../view/footer.php';
    }

    public function ver() {
        if (isset($_GET['id'])) {
            $post = $this->model->obtenerPorId($_GET['id']);
            $postId = $post->getId();

            $commentDao = new CommentDAO();
            $comments = $commentDao->obtenerPorPostId($post->getId());

            $user_id = $_SESSION['user_id'];
            $userDao = new UserDAO();
            $user = $userDao->obtenerPorId($user_id);
            $userName = $user->getName();




            require_once '../view/header.php';
            require_once '../view/post/ver.php';
            require_once '../view/footer.php';
        } else {
            header("Location: index.php?c=Post&a=index");
        }
    }

    public function crear() {
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
            $post->fetchCountryFromCoordinates();


            
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $_FILES['image']['name']);

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