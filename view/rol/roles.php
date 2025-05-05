<div class="container">
    <h2>Listado de Roles</h2>
    <a href="index.php?c=Rol&a=crear" class="btn btn-success">Crear nuevo rol</a>
    <table class="table table-bordered table-striped" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?= htmlspecialchars($rol->getId()) ?></td>
                    <td><?= htmlspecialchars($rol->getNombre()) ?></td>
                    <td>
                        <a href="index.php?c=Rol&a=eliminar&id=<?= $rol->getId() ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que deseas eliminar este rol?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
