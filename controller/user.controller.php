<?php
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

                $existingE = $this->model->obtenerPorEmail($email);
                $existingN = $this->model->obtenerPorNombre($name);

                if ($existingE) {
                    $errorMessage = "El correo ya está en uso.";
                } else if  ($existingN) {
                    $errorMessage = "El nombre de usuario ya está en uso.";
                
                } else {
                    $user = new User();
                    $user->setName($name);
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setRolId($rol_id);
                    $user->setImage("default.png");

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

    public function perfil() {
        $user = new User();
        $userId = $_SESSION['user_id'];
        $user = $this->model->obtenerPorId($userId);
        require_once '../view/header.php';
        require_once '../view/user/perfil.php';
        require_once '../view/footer.php';
    }

    public function editar() {
        $user = new User();
        $userId = $_SESSION['user_id'];
        $user = $this->model->obtenerPorId($userId);
        require_once '../view/header.php';
        require_once '../view/user/editar.php';
        require_once '../view/footer.php';
    }

    public function login() {
        $error = null;
    
        if ($_POST) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $user = $this->model->obtenerPorEmail($email);
    
            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['rol_id'] = $user->getRolId();

                if (isset($_POST['remember'])) {
                    setcookie('remembered_email', $_POST['email'], time() + (30 * 24 * 60 * 60), "/");
                } else {
                    setcookie('remembered_email', '', time() - 3600, "/");
                }
                header("Location: index.php?c=Pais&a=index");
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
        header("Location: index.php?c=Pais&a=index");
        exit();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminar($_GET['id']);
            header("Location: index.php?c=Pais&a=index");
        }
    }

    public function actualizar() {
        if ($_POST) {
            $name = $_POST['name'];
    
            $existingN = $this->model->obtenerPorNombre($name);
    
            if ($existingN) {
                $errorMessage = "El nombre de usuario ya está en uso.";
            }
    
            $user = $this->model->obtenerPorId($_SESSION['user_id']);
            $user->setName($name);
    
            if (!empty($_POST['password'])) {
                $user->setPassword($_POST['password']);
            }
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $filename = basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], 'userImg/' . $filename);
                $user->setImage($filename);
            }
    
            $this->model->actualizar($user);
    
            header("Location: index.php?c=User&a=perfil");
            exit;
        }
    }

    public function listar() {
        $users = $this->model->getAll();
        require_once '../view/header.php';
        require_once '../view/dashboard/listarUsers.php';
        require_once '../view/footer.php';
    }
    


}
