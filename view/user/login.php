<h1 class="base">Login</h1>
<?php
if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>";
?>
<form method="POST" action="index.php?c=User&a=login" class="form-container">

    <input type="text" name="email" placeholder="Email"
        value="<?php echo isset($_COOKIE['remembered_email']) ? $_COOKIE['remembered_email'] : ''; ?>">
    <input type="password" name="password" placeholder="Contraseña">
    <label>
        <input type="checkbox" name="remember"> Recordar email
    </label>
    <button type="submit">Iniciar Sesión</button>
    <p><a href="index.php?c=User&a=register">Registrarse</a></p>
    <p><a href="index.php?c=User&a=olvidadoPassword">He olvidado mi contraseña</a></p>
</form>

<?php
if (isset($_GET['restablecida'])) {
    if ($_GET['restablecida'] == 'ok') {
        echo "<div class='alert alert-success'>Contraseña restablecida correctamente.</div>";
    } else if ($_GET['restablecida'] == 'fail') {
        echo "<div class='alert alert-danger'>No se ha encontrado el correo.</div>";

    }
}
?>