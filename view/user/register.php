<form id="registerF" action="index.php?c=User&a=register" method="post" enctype="multipart/form-data">
    <div>
        <input type="text" name="user" placeholder="Username"
            value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" />
    </div>
    <?php if (!empty($errorMessage)): ?>
        <p name="errorM" class="alert-danger"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <div>
        <input type="text" name="email" placeholder="Email"
            value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
    </div>
    <div>
        <input type="password" placeholder="Contraseña" name="password" value="" />
    </div>
    <div>
        <input type="password" placeholder="Repetir contraseña" name="password2" value="" />
    </div>



    <button>Registrarse</button>

</form>

<script>
    document.getElementById('registerF').addEventListener('submit', function (event) {
        document.querySelectorAll('.alert-danger').forEach(el => el.remove());

        let hasError = false;

        let userInput = document.querySelector('input[name="user"]');
        let user = userInput.value.trim();
        if (user.length < 3) {
            let error = document.createElement('div');
            error.className = 'alert-danger';
            error.textContent = 'El nombre de usuario debe tener al menos 3 caracteres.';
            userInput.parentNode.insertBefore(error, userInput);
            hasError = true;
        } else if (user.length > 20) {
            let error = document.createElement('div');
            error.className = 'alert-danger';
            error.textContent = 'El nombre de usuario no puede tener más de 20 caracteres.';
            userInput.parentNode.insertBefore(error, userInput);
            hasError = true;
        }

        let emailInput = document.querySelector('input[name="email"]');
        let email = emailInput.value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            let error = document.createElement('div');
            error.className = 'alert-danger';
            error.textContent = 'Por favor, ingrese un correo válido.';
            emailInput.parentNode.insertBefore(error, emailInput);
            hasError = true;
        }

        let passwordInput = document.querySelector('input[name="password"]');
        let password = passwordInput.value.trim();
        if (!password || password.length < 6) {
            let error = document.createElement('div');
            error.className = 'alert-danger';
            error.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            passwordInput.parentNode.insertBefore(error, passwordInput);
            hasError = true;
        }

        let password2Input = document.querySelector('input[name="password2"]');
        let password2 = password2Input.value.trim();
        if (password != password2) {
            let error = document.createElement('div');
            error.className = 'alert-danger';
            error.textContent = 'Las contraseñas no coinciden.';
            password2Input.parentNode.insertBefore(error, password2Input);
            hasError = true;
        }

        if (hasError) {
            let mensajeC = document.querySelector('p[name="errorM"]');
            if (mensajeC) {
                mensajeC.remove();
            }
            event.preventDefault();
        }
    });
</script>