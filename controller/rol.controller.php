<?php
require_once '../model/entidades/rol.php';
require_once '../model/rolDAO.php';

class RolController {

    private $model;

    public function __construct() {
        $this->model = new RolDAO();
    }

    public function index() {
        $roles = $this->model->getAll();
        require_once '../view/header.php';
        require_once '../view/rol/roles.php';
        require_once '../view/footer.php';
    }

    public function crear() {
        require_once '../view/header.php';
        require_once '../view/rol/crear.php';
        require_once '../view/footer.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rol = new Rol();
            $rol->setNombre($_POST['nombre']);
            $this->model->save($rol);
            header("Location: index.php?c=Rol&a=index");
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
            header("Location: index.php?c=Rol&a=index");
        }
    }
}
