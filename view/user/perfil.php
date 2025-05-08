<h2>Perfil de Usuario</h2>

<?php if ($user): ?>
    <img src="userIMG/<?= htmlspecialchars($user->getImage()) ?>" alt="Imagen de perfil" width="150">
    <p>Nombre de usuario:<?= htmlspecialchars($user->getName()) ?></p>
    <p>Email:<?= htmlspecialchars($user->getEmail()) ?></p>
    
    <p><a href="index.php?c=User&a=editar">Editar perfil</a></p>
<?php else: ?>
    <p>Error al cargar los datos del usuario.</p>
<?php endif; ?>