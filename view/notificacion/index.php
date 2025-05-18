<h2>Notificaciones</h2>
<?php if (empty($notificaciones)): ?>
    <p>No tienes notificaciones nuevas.</p>
<?php else: ?>
    <ul>
        <?php foreach ($notificaciones as $notificacion): ?>
            <li style="margin-bottom: 10px; <?= $notificacion->getIsRead() ? 'color: gray;' : 'font-weight: bold;' ?>">
                <?= htmlspecialchars($notificacion->getMessage()) ?>
                <br>
                <small>
                    <?= $notificacion->getIsRead() ? 'Leída' : 'No leída' ?>
                </small>
                <br>
                <a href="index.php?c=notificacion&a=eliminar&id=<?= $notificacion->getId() ?>" onclick="return confirm('¿Seguro que quieres eliminar esta notificación?');">Eliminar</a> |
                <a href="index.php?c=Post&a=ver&id=<?= $notificacion->getPostId() ?>">Ver post</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
