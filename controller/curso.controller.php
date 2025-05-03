<?php

require_once '../model/cursoDAO.php'; //El nivel partida es el index, pero ahora está dentro de public.
require_once '../model/entidades/curso.php';
//Pendiente implementar validación en servidor

class CursoController {

    private $model; //Representa las operaciones de BD para el curso.

    public function __construct() {
        $this->model = new CursoDAO();
    }

    public function index() {
        require_once '../view/header.php';
        require_once '../view/curso/curso.php';
        require_once '../view/footer.php';
    }

    public function indexList() {
        require_once '../view/header.php';
        require_once '../view/curso/curso.php';
        require_once '../view/footer.php';
    }

    public function editar() {
        $curso = new Curso();

        if (isset($_REQUEST['id'])) {
            $curso = $this->model->obtener($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/curso-editar.php';
        require_once '../view/footer.php';
    }

    public function guardar() {
        /* Para realizar la validación podemos implementarla aquí o llamar a un método que nos recoja los datos del 
          Request y nos devuelva un bool para continuar y redirigir al index o para retornarnos al formulario de edición. */

        //Después de la validación
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['Nombre'];
        $horas = $_REQUEST['Horas'];

        $curso = new Curso();

        $curso->setId($id);
        $curso->setNombre($nombre);
        $curso->setHoras($horas);


        $curso->getId() > 0 ? $this->model->actualizar($curso) : $this->model->registrar($curso);

        header('Location: index.php?c=curso');
    }

    public function eliminar() {
        $this->model->eliminar($_REQUEST['id']);
        header('Location: index.php?c=curso');
    }

}
