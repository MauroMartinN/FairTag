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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/icon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/icon/favicon.svg" />
    <link rel="shortcut icon" href="/icon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png" />
    <link rel="manifest" href="/icon/site.webmanifest" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <script>
        if (<?= $usuarioLogueado ? 'true' : 'false' ?>) {
            document.addEventListener('DOMContentLoaded', function () {
                const toggle = document.getElementById('perfil-toggle');
                const menu = document.getElementById('perfil-menu');

                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
                });

                document.addEventListener('click', function (e) {
                    if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                        menu.style.display = 'none';
                    }
                });
            });
        }

    </script>

    <div class="page-wrapper backdrop-blur">
        <header class="main-header" role="banner"
            style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); background: rgba(255,255,255,0.7);">
            <div class="header-content">
                <a href="index.php?c=Pais&a=index" class="logo">
                    <img src="/icon/web-app-manifest-512x512.png" alt="Logo FairTag" class="logo-img" />FairTag
                </a>
                <nav class="main-nav" role="navigation" aria-label="Menú principal">
                    <ul>
                        <?php if ($usuarioLogueado): ?>
                            <li class="perfil-dropdown">
                                <a href="#" id="perfil-toggle" class="perfil-toggle">
                                    <img src="<?= htmlspecialchars($_SESSION['profile_image']) ?>" alt="Perfil"
                                        class="perfil-img-small">
                                </a>
                                <ul id="perfil-menu" class="perfil-menu" style="display: none;">
                                    <li><a href="index.php?c=User&a=perfil"><i class="fas fa-user"></i> Perfil</a></li>
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
                                    <?php if ($_SESSION['rol_id'] == 1): ?>
                                        <li><a href="index.php?c=Dashboard&a=index"><i class="fas fa-tachometer-alt"></i>
                                                Dashboard Admin</a></li>
                                    <?php endif; ?>
                                    <li><a href="index.php?c=User&a=logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
                                    </li>
                                </ul>
                            </li>

                        <?php else: ?>
                            <li><a href="index.php?c=User&a=login">Login</a></li>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>
        </header>
        <main role="main" class="" style="margin-top: 80px;">