<h2>Comentarios del Usuario</h2>

<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <p><strong>ID Comentario:</strong> <?= htmlspecialchars($comment->getId()) ?></p>
                <p><strong>Contenido:</strong><br> <?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($comment->getCreatedAt()) ?></p>
                <p><strong>ID del Post:</strong> <?= htmlspecialchars($comment->getPostId()) ?></p>
                <form action="index.php?c=Comment&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este comentario?');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($comment->getId()) ?>">
                    <input type="hidden" name="post_id" value="<?= htmlspecialchars($comment->getPostId()) ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron comentarios para este usuario.</p>
<?php endif; ?>
