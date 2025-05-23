<form method="POST" action="index.php?c=user&a=guardarNuevaPassword">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
    <label for="password">Nueva Contraseña:</label>
    <input type="password" name="password" required>
    <input type="hidden" name="token" id="token" value="<?=$_GET['token'] ?>" hidden>

    <button type="submit">Guardar</button>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        var password = document.querySelector('input[name="password"]').value;
        if (password.length < 6) {
            alert('La contraseña debe tener al menos 6 caracteres.');
            e.preventDefault();
        }
    });
</script>