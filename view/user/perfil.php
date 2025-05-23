<h2>Perfil de Usuario</h2>

<?php if ($user): ?>
    <img src="userIMG/<?= htmlspecialchars($user->getImage()) ?>" alt="Imagen de perfil" width="150">
    <p>Nombre de usuario:<?= htmlspecialchars($user->getName()) ?></p>
    <p>Email:<?= htmlspecialchars($user->getEmail()) ?></p>
    <?php if(isset($_GET['v']) && $_GET['v'] == 'ok'): ?>
        <p>Tienes que verificar el correo antes de crear o comentar posts.</p>
    <?php endif; ?>
    <?php if (isset($_GET['correo']) && $_GET['correo'] == 'ok'): ?>
        <p>✅ Se ha enviado el correo de verificación.</p>
    <?php elseif (isset($_GET['correo']) && $_GET['correo'] == 'fail'): ?>
        <p>❌ No se pudo enviar el correo.</p>
    <?php elseif ($user->getRolId() == 2): ?>
        <p>Hola, haz click en el <a href="index.php?c=user&a=enviarVerificacion">enlace</a> para verificar correo </p>
    <?php endif; ?>


    <a href="index.php?c=user&a=perfilPosts">Ver tus posts</a>
    <a href="index.php?c=user&a=favPosts">Ver tus posts favoritos</a>
    <p><a href="index.php?c=User&a=editar">Editar perfil</a></p>
<?php else: ?>
    <p>Error al cargar los datos del usuario.</p>
<?php endif; ?>