<form id="registerF" action="index.php?c=User&a=register" method="post" enctype="multipart/form-data">
    <div>
        <label>Usuario</label>
        <input type="text" name="user" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>"/>
    </div>
    <div>
        <label>Correo</label>
        <input type="text" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"/>
    </div>
    <div>
        <label>Contraseña</label>
        <input type="password" name="password" value=""/>
    </div>
    <div>
        <label>Vuelve a escribir la contraseña</label>
        <input type="password" name="password2" value=""/>
    </div>

    <?php if (!empty($errorMessage)): ?>
        <p name="errorM" style="color:red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    
    <button>Registrar</button>

</form>

<script>
    document.getElementById('registerF').addEventListener('submit', function(event) {
        document.querySelectorAll('.error-message').forEach(el => el.remove());

        let hasError = false;

        let userInput = document.querySelector('input[name="user"]');
        let user = userInput.value.trim();
        if (!user) {
            let error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'El campo Usuario es obligatorio.';
            userInput.after(error);
            hasError = true;
        }
        if (user.length < 3) {
            let error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'El nombre de usuario debe tener al menos 3 caracteres.';
            userInput.after(error);
            hasError = true;
        }
        if (user.length > 20) {
            let error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'El nombre de usuario no puede tener más de 20 caracteres.';
            userInput.after(error);
            hasError = true;
        }

        let emailInput = document.querySelector('input[name="email"]');
        let email = emailInput.value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            let error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'Por favor, ingrese un correo válido.';
            emailInput.after(error);
            hasError = true;
        }

        let passwordInput = document.querySelector('input[name="password"]');
        let password = passwordInput.value.trim();
        if (!password || password.length < 6) {
            let error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            passwordInput.after(error);
            hasError = true;
        }

        let password2Input = document.querySelector('input[name="password2"]');
        let password2 = password2Input.value.trim();
        if (password != password2) {
            let error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'Las contraseñas no coinciden.';
            password2Input.after(error);
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
