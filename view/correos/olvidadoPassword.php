<h2 class="base">¿Olvidaste tu contraseña?</h2>


<form action="index.php?c=user&a=enviarPassword" method="POST" class="form-container">
    <p>Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
    <br>
    <label for="email">Correo electrónico:</label>
    <input type="text" name="email" id="email" required placeholder="Introduce tu correo electrónico">
    <br><br>
    <button type="submit">Enviar enlace</button>
    <br><br>
    <p><a href="index.php?c=user&a=login">Volver al inicio de sesión</a></p>

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