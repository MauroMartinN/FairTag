<?php
require_once '../model/userDAO.php';
require_once '../model/entidades/user.php';
require_once '../model/postDAO.php';

class UserController {

    private $model;

    public function __construct() {
        $this->model = new UserDAO();
    }

    public function register() {
        $errorMessage = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['user'])) {
                $name     = trim($_POST['user']);
                $email    = trim($_POST['email']);
                $password = trim($_POST['password']);
                $rol_id   = 2;

                $existingE = $this->model->obtenerPorEmail($email);
                $existingN = $this->model->obtenerPorNombre($name);

                if ($existingN) {
                    $errorMessage = "El nombre de usuario ya está en uso.";
                } else if  ($existingE) {
                    $errorMessage = "El correo ya está en uso.";
                
                } else {
                    $user = new User();
                    $user->setName($name);
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setRolId($rol_id);
                    $user->setImage("default.png");
                    $user->setToken(null);

                    $this->model->registrar($user);

                    header("Location: index.php?c=User&a=login&Registrado=ok");
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
        $errorMessage = null;
        if (isset($_GET['error'])) {
            $errorMessage = $_GET['error'];
        }
        $user = new User();
        $userId = $_SESSION['user_id'];
        $user = $this->model->obtenerPorId($userId);
        require_once '../view/header.php';
        require_once '../view/user/editar.php';
        require_once '../view/footer.php';
    }

    public function login() {
        $error = null;
        $mensaje = null;

        if (isset($_GET['Registrado'])) {
            if ($_GET['Registrado'] == 'ok') {
                $mensaje = "Usuario registrado correctamente. Por favor, inicia sesión.";
            }
        }


    
        if ($_POST) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $user = $this->model->obtenerPorEmail($email);
    
            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['rol_id'] = $user->getRolId();
                $_SESSION['profile_image'] = "/userImg/".$user->getImage();

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
    if (isset($_POST['id'])) {
        $this->model->eliminar($_POST['id']);
        header("Location: index.php?c=Pais&a=index");
        exit();
    }
    else {
        header("Location: index.php?c=Post&a=index");
        exit();
    }
}

    public function actualizar() {
    if ($_POST) {
        $name = $_POST['name'];

        $existingN = $this->model->obtenerPorNombre($name);

        if ($existingN && $existingN->getId() !== $_SESSION['user_id']) {
            $errorMessage = "El nombre de usuario ya está en uso.";
            header("Location: index.php?c=User&a=editar&error=" . urlencode($errorMessage));
            exit();
        }

        $user = $this->model->obtenerPorId($_SESSION['user_id']);
        $user->setName($name);

        $croppedImage = $_POST['cropped_image'] ?? null;

        if ($croppedImage) {
            $croppedImage = str_replace('data:image/png;base64,', '', $croppedImage);
            $croppedImage = str_replace(' ', '+', $croppedImage);
            $imageData = base64_decode($croppedImage);

            $uniqueName = uniqid('user_', true) . '.png';
            file_put_contents('userImg/' . $uniqueName, $imageData);

            $user->setImage($uniqueName);
        }

        $this->model->actualizar($user);

        header("Location: index.php?c=User&a=perfil");
        exit();
    }
}


    public function listar() {
        $users = $this->model->getAll();
        require_once '../view/header.php';
        require_once '../view/dashboard/listarUsers.php';
        require_once '../view/footer.php';
    }

    public function perfilPosts() {
        $postDAO = new PostDAO();

        $userId = $_SESSION['user_id'];
        $user = $this->model->obtenerPorId($userId);
        $posts = $postDAO->obtenerPorUsuarioId($userId);
        require_once '../view/header.php';
        require_once '../view/user/listaPosts.php';
        require_once '../view/footer.php';
    }

    public function favPosts() {
        $postDAO = new PostDAO();

        $userId = $_SESSION['user_id'];
        $user = $this->model->obtenerPorId($userId);
        $posts = $postDAO->obtenerFavoritosPorUsuarioId($userId);
        require_once '../view/header.php';
        require_once '../view/user/listaPosts.php';
        require_once '../view/footer.php';
    }

    public function alternarPostFavorito() {
        if (isset($_SESSION['user_id'], $_POST['post_id'])) {
            $userId = $_SESSION['user_id'];
            $postId = $_POST['post_id'];

            $resultado = $this->model->alternarFavorito($userId, $postId);

            header("Location: index.php?c=Post&a=ver&id=" . $postId);
            exit();
        }  
    }

    public function enviarVerificacion() {
    $userid = $_SESSION['user_id'];
    $user = $this->model->obtenerPorId($userid);

    if ($this->enviarCorreoVerificacion($user)) {
        header("Location: index.php?c=user&a=perfil&correo=ok");
    } else {
        header("Location: index.php?c=user&a=perfil&correo=fail");
    }
    exit();
}



    public function enviarCorreoVerificacion($user) {
        $token = bin2hex(random_bytes(16));
        $user->setToken($token);
        $this->model->actualizar($user);
        $urlBase = "http://localhost/index.php?c=user&a=verificarCorreo&token=";
        $link = $urlBase . urlencode($token);

        $to = $user->getEmail();
        $subject = "Verifica tu correo en FairTag";
        $message = "Hola " . htmlspecialchars($user->getName()) . ",\n\n";
        $message .= "Gracias por registrarte en FairTag.\n";
        $message .= "Por favor, haz clic en el siguiente enlace para verificar tu correo electrónico:\n\n";
        $message .= $link . "\n\n";
        $message .= "Si no solicitaste esta verificación, puedes ignorar este correo.\n\n";
        $message .= "Saludos,\nEl equipo de FairTag";

        return mail($to, $subject, $message);
    }

    public function verificarCorreo() {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $estadoVerificacion = $this->model->checkCorreoVerificacion($token);
            require_once '../view/correos/estadoVerificacion.php';

        }
    }

    public function olvidadoPassword() {
        require_once '../view/header.php';
        require_once '../view/correos/olvidadoPassword.php';
        require_once '../view/footer.php';
    }

    public function enviarPassword() {
        $user = $this->model->obtenerPorEmail($_POST['email']);
        if (!$user) {
            header("Location: index.php?c=user&a=olvidadoPassword&reset=fail");
        } else {
            $this->enviarCorreoPassword($user);
            header("Location: index.php?c=user&a=olvidadoPassword&correo=ok");
        }
        exit();
    }

    public function enviarCorreoPassword($user) {
        $token = bin2hex(random_bytes(16));
        $user->setToken($token);
        $this->model->actualizar($user);
        $urlBase = "http://localhost/index.php?c=user&a=resetPassword&token=";
        $link = $urlBase . urlencode($token);

        $to = $user->getEmail();
        $subject = "Restablecer contraseña en FairTag";
        $message = "Hola " . htmlspecialchars($user->getName()) . ",\n\n";
        $message .= "Recibimos una solicitud para restablecer tu contraseña.\n";
        $message .= "Por favor, haz clic en el siguiente enlace para restablecer tu contraseña:\n\n";
        $message .= $link . "\n\n";
        $message .= "Si no solicitaste este cambio, puedes ignorar este correo.\n\n";
        $message .= "Saludos,\nEl equipo de FairTag";

        return mail($to, $subject, $message);
    }


    public function resetPassword() {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $user = $this->model->obtenerPorToken($token);

            if ($user) {
                require_once '../view/header.php';
                require_once '../view/correos/resetearPassword.php';
                require_once '../view/footer.php';
            } else {
                echo "Token inválido o expirado.";
            }
        }
    }

    public function guardarNuevaPassword() {
        if ($_POST && isset($_POST['token']) && isset($_POST['password'])) {
            $token = $_POST['token'];
            $nuevaPassword = $_POST['password'];
            $user = $this->model->obtenerPorToken($token);

            if ($user) {
                $hashedPassword = password_hash($nuevaPassword, PASSWORD_DEFAULT);
                $user->setPassword($hashedPassword);
                $user->setToken(null);
                $this->model->actualizarPasswordToken($user);

                header("Location: index.php?c=user&a=login&restablecida=ok");
            } else {
                header("Location: index.php?c=user&a=login&restablecida=fail");
            }
            exit();
        }
    }
    


}
