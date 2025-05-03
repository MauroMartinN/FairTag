<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejemplo MVC con entidad y controller - Inicio de sesión</title>

        <meta charset="utf-8" />

        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="/assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="/assets/css/style.css" />


        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    </head>
    <body>



        <div class="container">
           
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav ">
                    <li class="active"><a href="index.php?c=Usuario&a=login">Login</a></li>
                    <li><a href="index.php?c=Usuario&a=iniciarRegistro">Registro Usuario</a></li>
                    <!-- Otras opciones del menú sin logeo --> 
                    <li><a href="nosotros.php">Sobre nosotros</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    
                </ul>
            </div><!--/.nav-collapse -->
        </div>
        
        <!-- En lugar de dos ficheros de cabecera, podemos poner el menú en un fichero separado y escoger el que necesitemos. -->
