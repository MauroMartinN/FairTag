<h1 class="page-header">Login</h1>
<?php 
if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; 
?>
<form method="POST" action="index.php?c=User&a=login">

    <input type="text" name="email" placeholder="Email" value="<?php echo isset($_COOKIE['remembered_email']) ? $_COOKIE['remembered_email'] : ''; ?>">
    <input type="password" name="password" placeholder="Contraseña">
    <label>
        <input type="checkbox" name="remember"> Recordar email
    </label>
    <button type="submit">Iniciar Sesión</button>
</form>
<p><a href="index.php?c=User&a=register">Registrarse</a></p>
