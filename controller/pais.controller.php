<?php
require_once '../model/entidades/pais.php';
require_once '../model/paisDAO.php';
require_once '../model/costesDAO.php';
require_once '../services/fetchCountry.php';

class PaisController
{
    private $model;

    public function __construct()
    {
        $this->model = new PaisDAO();
    }

    public function index()
    {
        require_once '../view/header.php';
        require_once '../view/pais/index.php';
        require_once '../view/footer.php';
    }

    public function ver()
    {
        $paisNombre = $_GET['pais'] ?? null;
        $lat = $_GET['lat'] ?? null;
        $lon = $_GET['lon'] ?? null;

        if (!$paisNombre) {
            header('Location: index.php?c=pais&a=index');
            exit();
        }

        $pais = $this->model->obtenerPorNombre($paisNombre);
        $zoom = 6;

        if (!$pais) {
            header('Location: index.php?c=pais&a=index');
            exit();
        } else {

            $costesDAO = new CostesDAO();

            if (isset($_GET['city'])) {
                $ciudad = $_GET['city'];
                $costes = $costesDAO->obtenerPorCiudad($ciudad);
                $coordenadas = fetchCoordinatesFromCity($ciudad);

                if ($coordenadas) {
                    $lat = $coordenadas['lat'];
                    $lon = $coordenadas['lon'];
                    $zoom = 10;
                }
            } else {

                $costes = null;
                $ciudades = $costesDAO->obtenerCiudadesPorCountryId($pais->getId());

            }
            $tipo = $_GET['type'] ?? null;
            $posts = $this->model->obtenerPosts($pais->getId(), $tipo);
        }

        require_once '../view/header.php';
        include_once '../view/pais/ver.php';
        require_once '../view/footer.php';
    }



}
