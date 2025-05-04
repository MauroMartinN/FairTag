<?php
session_start();
require_once '../model/userDAO.php';
require_once '../model/entidades/user.php';

class UserController {

    private $model;

    public function __construct() {
        $this->model = new UserDAO();
    }

    public function register() {
        $errorMessage = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['user'])) {
                $name     = trim($_POST['user']);
                $email    = trim($_POST['email']);
                $password = trim($_POST['password']);
                $rol_id   = 1;

                $existing = $this->model->obtenerPorEmail($email);
                if ($existing) {
                    $errorMessage = "Ya existe un usuario registrado con ese correo.";
                } else {
                    $user = new User();
                    $user->setName($name);
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setRolId($rol_id);

                    $this->model->registrar($user);

                    header("Location: index.php?c=User&a=login");
                    exit;
                }
            }
        }

        require_once '../view/header.php';
        require_once '../view/user/register.php';
        require_once '../view/footer.php';
    }
    public function index() {
        require_once '../view/header.php';
        require_once '../view/map/inicioMap.php';
        require_once '../view/footer.php';
    }

    // public function editar() {
    //     $user = new User();

    //     if (isset($_REQUEST['id'])) {
    //         $user = $this->model->obtenerPorId($_REQUEST['id']); 
    //     }
    // }

    public function login() {
        $error = null;
    
        if ($_POST) {
        
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $user = $this->model->obtenerPorEmail($email);
    
            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = $user;

                if (isset($_POST['remember'])) {
                    setcookie('remembered_email', $_POST['email'], time() + (30 * 24 * 60 * 60), "/");
                } else {
                    setcookie('remembered_email', '', time() - 3600, "/");
                }
                header("Location: index.php?c=User");
                exit();
            } else {
                $error = "Email o contraseña incorrectos";
            }
        }
    
        require_once '../view/header.php';
        require_once '../view/user/login.php';
        require_once '../view/footer.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=User");
        exit();
    }
    
}
