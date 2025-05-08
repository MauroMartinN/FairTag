<?php
$usuarioLogueado = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>FairTag</title>
    <meta charset="utf-8" />
</head>
<body>
    <div>
        <div>
            <ul>
                <li><a href="index.php?c=User&a=index">Inicio</a></li>
                <?php if ($usuarioLogueado): ?>
                    <li><a href="index.php?c=User&a=logout">Salir</a></li>
                    <li><a href="index.php?c=Post&a=crear">Crear Post</a></li>
                    <li><a href="index.php?c=User&a=perfil">Perfil</a></li>
                <?php else: ?>
                    <li><a href="index.php?c=User&a=login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>