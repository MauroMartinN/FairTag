
<h1 class="page-header">Login</h1>
<!-- EN CONSTRUCCIÓN -->
<?php

if ($_POST) {
    require_once '../model/usuarioDAO.php';
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->obtenerPorUsuario($_POST['usuario']);
    if ($usuario && password_verify($_POST['password'], $usuario->getPassword())) {
        echo "Usuario autenticado";
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<form method="POST" action="index.php?c=Usuario&a=login">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="password" placeholder="Contraseña">
    <button type="submit">Iniciar Sesión</button>
</form>

