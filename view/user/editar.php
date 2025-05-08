<h2>Editar Perfil</h2>

<form action="index.php?c=User&a=actualizar" method="POST" enctype="multipart/form-data">
    <div>
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->getName()) ?>" required>
    </div>


    <div>
        <label for="image">Imagen de Perfil:</label>
        <input type="file" id="image" name="image" accept="image/*">
        <?php if ($user->getImage()): ?>
            <p>Imagen actual:</p>
            <img src="userImg/<?= htmlspecialchars($user->getImage()) ?>" alt="Imagen de perfil" width="100">
        <?php endif; ?>
    </div>

    <button type="submit">Guardar Cambios</button>
</form>

<a href="index.php?c=User&a=perfil">Volver al perfil</a>
