<?php
require_once '../model/notificacionDAO.php';

class NotificacionController {
    private $model;

    public function __construct() {
        $this->model = new NotificacionDAO();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=User&a=login");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $notificaciones = $this->model->obtenerPorUsuario($userId);

        require_once '../view/header.php';
        require_once '../view/notificacion/index.php';
        require_once '../view/footer.php';
    }

    public function eliminar() {
        if (isset($_POST['id'])) {
            $this->model->eliminar($_POST['id']);
        } 
        header("Location: index.php?c=Notificacion&a=index");
        exit();
    }

    public function eliminarLeidas() {
        $userId = $_SESSION['user_id'];
        $this->model->eliminarLeidas($userId);
        header("Location: index.php?c=Notificacion&a=index");
        exit();
    }

    public function eliminarTodas() {
        $userId = $_SESSION['user_id'];
        $this->model->eliminarTodas($userId);
        header("Location: index.php?c=Notificacion&a=index");
        exit();
    }

    public function marcarTodasComoLeidas() {
        $userId = $_SESSION['user_id'];
        $this->model->marcarTodasComoLeidas($userId);
        header("Location: index.php?c=Notificacion&a=index");
        exit();
    }
}
