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
                <form action="index.php?c=notificacion&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar esta notificación?');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($notificacion->getId()) ?>">
                    <button type="submit" class="btn-link">Eliminar</button>
                </form>
                |
                <a href="index.php?c=Post&a=ver&id=<?= $notificacion->getPostId() ?>">Ver post</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
