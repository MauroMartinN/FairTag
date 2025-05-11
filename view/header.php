<?php
$usuarioLogueado = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>FairTag</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
  .leaflet-control-attribution {
    font-size: 14px;       /* Aumenta el tamaño de letra */
    padding: 8px 12px;      /* Más espacio alrededor */
    background: rgba(255, 255, 255, 0.8); /* Fondo más visible */
    color: #000;            /* Texto oscuro para más contraste */
  }
</style>
</head>
<body>
    <div>
        <div>
            <ul>
                <li><a href="index.php?c=Pais&a=index">Inicio</a></li>
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