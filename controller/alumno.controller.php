<?php
require_once '../model/alumnoDAO.php';
require_once '../model/entidades/alumno.php';

/*
 * ¿Qué va a hacer el controlador?
 * Implementar las diferentes acciones que se pueden ejecutar desde la vista. 
 * Instanciar al modelo.
 * Modificar sus propiedades (cuando sea necesario).
 * Llamar a uno de sus métodos (el cual, nos retornará algún dato).
 * Enviar los datos retornados por el modelo a la vista.
 */

//Pendiente implementar validación en servidor

class AlumnoController{
    
    private $model; //Representa las operaciones de BD para el alumno.
    
    public function __construct(){
        $this->model = new AlumnoDAO();
    }
    
    public function index(){
        require_once '../view/header.php';
        require_once '../view/alumno/alumno.php';
        require_once '../view/footer.php';
    }
    
    public function editar(){
        $alm = new Alumno();
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->obtener($_REQUEST['id']);  //Al DAO le solicitamos recuperar un alumno.
        }
        
        require_once '../view/header.php';
        require_once '../view/alumno/alumno-editar.php';
        require_once '../view/footer.php';
    }
    
    public function guardar(){
        /*Para realizar la validación podemos implementarla aquí o llamar a un método que nos recoja los datos del 
        Request y nos devuelva un bool para continuar y redirigir al index o para retornarnos al formulario de edición. */
        
        //Después de la validación
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['Nombre'];
        $apellido = $_REQUEST['Apellido'];
        $correo = $_REQUEST['Correo'];
        // $sexo = $_REQUEST['Sexo'];
        $sexo = (isset($_REQUEST['Sexo'])) ? $_REQUEST['Sexo'] : 0;
        $fechaNacimiento = $_REQUEST['FechaNacimiento'];

        //limpar los campos
        $nombre = trim($nombre);
        $apellido = trim($apellido);
        $correo = trim($correo);
        $fechaNacimiento = trim($fechaNacimiento);

        //validacion nombre- solo puede contener letras y 3-50 caracteres
            //si no cumple la validacion modifico la variable del mensaje de error
        $mensajeError = [];

        if (strlen($nombre) < 3 || strlen($nombre) > 50 || !ctype_alpha($nombre)) {
            $mensajeError[] = "El nombre debe contener solo letras y tener entre 3 y 50 caracteres.";
        }

        if (strlen($apellido) < 3 || strlen($apellido) > 50 || !ctype_alpha($apellido)) {
            $mensajeError[] = "El apellido debe contener solo letras y tener entre 3 y 50 caracteres.";
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $mensajeError[] = "El correo no es válido.";
        }

        if (!empty($mensajeError)) {
            require_once '../view/header.php';
            require_once '../view/alumno/alumno-editar.php';
            require_once '../view/footer.php';
            return;
        }

        //validacion apellido- solo puede contener letras y 3-50 caracteres
            //si no cumple la validacion modifico la variable del mensaje de error

                
        $alm = new Alumno();
                        
        $alm->setId($id);
        $alm->setNombre($nombre); 
        $alm->setApellido($apellido);
        $alm->setCorreo($correo);
        $alm->setSexo($sexo);
        $alm->setFechaNacimiento($fechaNacimiento);

        //si validacion ok -count($mensajeError)==0- guardo en la BD
        if (count($mensajeError) == 0) {
            echo "entro";
        $alm->getId() > 0 
            ? $this->model->actualizar($alm)
            : $this->model->registrar($alm);
        
        header('Location: index.php?c=alumno');
        }

        //else volvemos al formulario e imprimo los mensajes de error
        if (!empty($mensajeError)) {
            require_once '../view/header.php';
            require_once '../view/alumno/alumno-editar.php';
            require_once '../view/footer.php';
            return;
        }
    }
    
    public function eliminar(){
        $this->model->eliminar($_REQUEST['id']);
        header('Location: index.php?c=alumno');
    }
}