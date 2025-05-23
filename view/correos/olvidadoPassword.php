<h2>¿Olvidaste tu contraseña?</h2>

<p>Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

<form action="index.php?c=user&a=enviarPassword" method="POST">
    <label for="email">Correo electrónico:</label><br>
    <input type="email" name="email" id="email" required><br><br>
    
    <button type="submit">Enviar enlace</button>
</form>
<?php
if (isset($_GET['correo'])) {
    $correo = $_GET['correo'];
    echo "<p>Se ha enviado un enlace a tu correo electrónico.</p>";
}
if (isset($_GET['reset'])) {
    echo "<p>No se ha encontrado el correo.</p>";
}
?>

<p><a href="index.php?c=user&a=login">Volver al inicio de sesión</a></p>
