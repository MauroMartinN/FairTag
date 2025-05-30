<?php if ($mensaje): ?>
    <div id="popup-mensaje" class="popup-mensaje">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>


<h1 class="base">Login</h1>
<?php if ($error): ?>
    <div id="popup-mensaje" class="popup-mensaje-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>


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

<script>
    setTimeout(function () {
        var popup = document.getElementById('popup-mensaje');
        if (popup) {
            popup.style.opacity = '0';
            setTimeout(function () {
                popup.style.display = 'none';
            }, 500);
        }
    }, 3000);
</script>