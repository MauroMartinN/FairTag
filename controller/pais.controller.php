<?php
require_once '../model/entidades/pais.php';
require_once '../model/paisDAO.php';

class PaisController {
    private $model;

    public function __construct() {
        $this->model = new PaisDAO();
    }

    public function index() {
        $paises = $this->model->obtenerTodos();
        require_once '../view/header.php';
        require_once '../view/pais/index.php';
        require_once '../view/footer.php';
    }

    public function ver() {
        if (isset($_GET['id'])) {
            $pais = $this->model->obtenerPorId($_GET['id']);
            require_once '../view/header.php';
            require_once '../view/pais/ver.php';
            require_once '../view/footer.php';
        } else {
            header("Location: index.php?c=Pais&a=index");
        }
    }
}