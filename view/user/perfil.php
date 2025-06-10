<div class="container perfil-container">
    <h2>Perfil de Usuario</h2>

    <?php if ($user): ?>
        <div class="perfil-info">
            <img src="userIMG/<?= htmlspecialchars($user->getImage()) ?>" alt="Imagen de perfil" class="perfil-img" />
            <div class="perfil-datos">
                <p><strong>Nombre de usuario:</strong> <?= htmlspecialchars($user->getName()) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user->getEmail()) ?></p>

                <?php if (isset($_GET['v']) && $_GET['v'] == 'ok'): ?>
                    <p class="info mensaje">⚠️ Tienes que verificar el correo antes de crear o comentar posts.</p>
                <?php endif; ?>

                <?php if (isset($_GET['correo']) && $_GET['correo'] == 'ok'): ?>
                    <p class="exito">✅ Se ha enviado el correo de verificación.</p>
                <?php elseif (isset($_GET['correo']) && $_GET['correo'] == 'fail'): ?>
                    <p class="error">❌ No se pudo enviar el correo.</p>
                <?php elseif ($user->getRolId() == 2): ?>
                    <p>Hola, haz click en el <a href="index.php?c=user&a=enviarVerificacion" class="link-verificar">enlace</a> para verificar correo.</p>
                <?php elseif ($user->getRolId() == 3): ?>
                    <p>Cuenta verificada ✅</p>
                <?php endif; ?>

                <div class="links-usuario">
                    <a href="index.php?c=user&a=perfilPosts" class="btn">Ver tus posts</a>
                    <a href="index.php?c=user&a=favPosts" class="btn btn-secondary">Ver tus posts favoritos</a>
                    <a href="index.php?c=User&a=editar" class="btn btn-editar">Editar perfil</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="error">Error al cargar los datos del usuario.</p>
    <?php endif; ?>
</div>