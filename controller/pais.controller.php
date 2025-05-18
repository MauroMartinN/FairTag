<?php
require_once '../model/entidades/pais.php';
require_once '../model/paisDAO.php';

class PaisController {
    private $model;

    public function __construct() {
        $this->model = new PaisDAO();
    }

    public function index() {
        require_once '../view/header.php';
        require_once '../view/pais/index.php';
        require_once '../view/footer.php';
    }

    public function ver() {
        $lat = $_GET['lat'] ?? null;
        $lon = $_GET['lon'] ?? null;
        $paisNombre = $this->fetchCountryFromCoordinates($lat, $lon);

        if (!$paisNombre) header('Location: index.php?controller=pais&action=index');
            

        $pais = $this->model->obtenerPorNombre($paisNombre);

        if (!$pais) {
            $pais = new Pais();
            $pais->setName($paisNombre);
            $this->model->añadir($pais);
            $posts=[];
            
        } else {
            $posts = $this->model->obtenerPosts($pais->getId());
            foreach ($posts as $post) {
            }
        }

        require_once '../view/header.php';
        include_once '../view/pais/ver.php';
        require_once '../view/footer.php';
    }
        

    /**
     * Obtiene el nombre del país a partir de coordenadas geográficas (latitud y longitud).
     * 
     * Esta función hace una petición HTTP a la API de Nominatim (OpenStreetMap) para
     * obtener datos geográficos a partir de coordenadas.
     */
    private function fetchCountryFromCoordinates(String $lat, String $lon) {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lon}&zoom=5&addressdetails=1";
    
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: MyApp/1.0\r\nAccept-Language: es"
            ]
        ];

        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
    
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['address']['country'])) {
                return $data['address']['country'];
            }
        }
    
        return false;
    }
}
    