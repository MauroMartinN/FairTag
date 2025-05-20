<h2>Notificaciones</h2>
<?php if (empty($notificaciones)): ?>
    <p>No tienes notificaciones nuevas.</p>
<?php else: ?>
    <ul>
        <li>
            <a href="index.php?c=notificacion&a=marcarTodasComoLeidas">Marcar todas como leídas</a>
        </li>
        <li>
            <a href="index.php?c=notificacion&a=eliminarTodas">Eliminar todas</a>
        </li>
        <li>
            <a href="index.php?c=notificacion&a=eliminarLeidas">Eliminar leídas</a>
        </li>

        
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
