<h2>Comentarios del Usuario</h2>

<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <p><strong>ID Comentario:</strong> <?= htmlspecialchars($comment->getId()) ?></p>
                <p><strong>Contenido:</strong><br> <?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($comment->getCreatedAt()) ?></p>
                <p><strong>ID del Post:</strong> <?= htmlspecialchars($comment->getPostId()) ?></p>
                <a href="index.php?c=Comment&a=eliminar&id=<?= $comment->getId() ?>" onclick="return confirm('¿Seguro que quieres eliminar este comentario?')">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron comentarios para este usuario.</p>
<?php endif; ?>
