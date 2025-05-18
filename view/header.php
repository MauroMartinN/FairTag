<?php
require_once '../model/notificacionDAO.php'; 
$usuarioLogueado = isset($_SESSION['user_id']);
$tieneNotificaciones = false;

if ($usuarioLogueado) {
    $notificationDao = new NotificacionDAO();
    $notificaciones = $notificationDao->obtenerPorUsuario($_SESSION['user_id']);

    foreach ($notificaciones as $notificacion) {
        if (!$notificacion->getIsRead()) {
            $tieneNotificaciones = true;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>FairTag</title>
    <meta charset="utf-8" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/icon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/icon/favicon.svg" />
    <link rel="shortcut icon" href="/icon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png" />
    <link rel="manifest" href="/icon/site.webmanifest" />
</head>
<body>
    <div>
        <div>
            <ul>
                <li><a href="index.php?c=Pais&a=index">Inicio</a></li>
                <?php if ($usuarioLogueado): ?>
                    <li>
                        <a href="index.php?c=Notificacion&a=index">
                            <?php if ($tieneNotificaciones): ?>
                                <i class="fas fa-bell" style="color: red;"></i>
                            <?php else: ?>
                                 <i class="fas fa-bell-slash" style="color: gray;"></i>
                            <?php endif; ?>
                            Notificaciones
                        </a>
                    </li>
                    <li><a href="index.php?c=User&a=perfil">Perfil</a></li>
                    <li><a href="index.php?c=User&a=logout">Salir</a></li>
                <?php else: ?>
                    <li><a href="index.php?c=User&a=login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
