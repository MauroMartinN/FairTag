<?php
require_once '../model/denunciaDAO.php';

class DenunciaController
{
    private $model;

    public function __construct()
    {
        $this->model = new DenunciaDAO();
    }
    public function listarDenuncias()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != '1') {
            header("Location: index.php?c=Pais&a=index");
            exit();
        }

        $denuncias = $this->model->obtenerTodas();
        require_once '../view/header.php';
        require_once '../view/dashboard/listarDenuncias.php';
        require_once '../view/footer.php';
    }

    public function eliminarDenunciasConContenidoId()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != '1') {
            header("Location: index.php?c=Pais&a=index");
            exit();
        }
        $contenidoId = $_POST['contenidoId'];
        $this->model->eliminarDenunciasConContenidoId($contenidoId);
        header("Location: index.php?c=Denuncia&a=listarDenuncias");
        exit();
    }
}
