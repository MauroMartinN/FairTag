<?php

require_once '../model/usuarioDAO.php';
require_once '../model/entidades/usuario.php';

class UsuarioController {  //PENDIENTE DE PONER LAS VISTAS

    private $model; //Representa las operaciones de BD para el curso.

    public function __construct() {
        $this->model = new UsuarioDAO();
    }

    public function index() {
        require_once '../view/headerStart.php';
        require_once '../view/usuario/inicio.php';
        require_once '../view/footer.php';
    }

    public function iniciarRegistro() {
        require_once '../view/headerStart.php';
        require_once '../view/usuario/registro.php';
        require_once '../view/footer.php';
    }

    public function registrar() {
        //Después de la validación
        $nombre = $_REQUEST['nombre'];
        $usuarioNombre = $_REQUEST['usuario'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $privilegio = 2; //Número entero representa el tipo de usuario - El usuario si tiene opción de registro no debería de poder asignarse rol el mismo, por eso no se añade como opción en el formulario.

        $usuario = new Usuario();

        $usuario->setNombre($nombre);
        $usuario->setUsuario($usuarioNombre);
        $usuario->setPrivilegio($privilegio);
        $usuario->setEmail($email);
        $usuario->setPassword($password);

        $this->model->registrar($usuario);

        header('Location: index.php?c=usuario');
    }

    public function editar() {
        $usuario = new Usuario();

        if (isset($_REQUEST['id'])) {
            $usuario = $this->model->obtener($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/usuario/usuario-editar.php';
        require_once '../view/footer.php';
    }

    public function login() {
        require_once '../view/header.php';
        require_once '../view/usuario/login.php';
        require_once '../view/footer.php';
        
    }

}
