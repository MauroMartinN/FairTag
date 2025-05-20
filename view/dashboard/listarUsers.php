<h2>Listado de Usuarios</h2>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->getId()) ?></td>
                <td><?= htmlspecialchars($user->getName()) ?></td>
                <td><?= htmlspecialchars($user->getEmail()) ?></td>
                <td>
                    <?php
                        switch ($user->getRolId()) {
                            case 1: echo "Administrador"; break;
                            case 2: echo "Usuario"; break;
                            case 3: echo "Usuario Verificado"; break;
                            default: echo "Desconocido"; break;
                        }
                    ?>
                </td>
                <td>
                    <img src="userImg/<?= htmlspecialchars($user->getImage()) ?>" alt="Imagen" width="100" height="100">
                </td>
                <td>
                    <a href="index.php?c=Post&a=listarPorUserId&id=<?= $user->getId() ?>">Ver Posts</a> |
                    <a href="index.php?c=Comment&a=listarPorUserId&id=<?= $user->getId() ?>">Ver Comentarios</a> |
                    <a href="index.php?c=User&a=eliminar&id=<?= $user->getId() ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
