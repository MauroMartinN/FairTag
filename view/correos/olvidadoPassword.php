<h2 class="base">¿Olvidaste tu contraseña?</h2>


<form action="index.php?c=user&a=enviarPassword" method="POST" class="form-container">
    <p>Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
    <br>
    <label for="email">Correo electrónico:</label>
    <?php
    if (isset($_GET['correo'])) {
        $correo = $_GET['correo'];
        echo "<p class='exito'>Se ha enviado un enlace a tu correo electrónico.</p><br>";
    }
    if (isset($_GET['reset'])) {
        echo "<p class='error'>No se ha encontrado tu correo en la base de datos.</p><br>";

    }
    ?>

    <input type="text" name="email" id="email" required placeholder="Introduce tu correo electrónico">
    <br><br>
    <button type="submit">Enviar enlace</button>
    <br><br>
    <p><a href="index.php?c=user&a=login">Volver al inicio de sesión</a></p>

</form>