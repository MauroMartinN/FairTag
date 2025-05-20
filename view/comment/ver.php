<h2>Detalle del Comentario</h2>

<?php if ($comment): ?>
    <p><strong>ID:</strong> <?= htmlspecialchars($comment->getId()) ?></p>
    <p><strong>Contenido:</strong><br><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
    <p><strong>ID del Usuario:</strong> <?= htmlspecialchars($comment->getUserId()) ?></p>
    <p><strong>ID del Post:</strong> <?= htmlspecialchars($comment->getPostId()) ?></p>
    <p><strong>Fecha:</strong> <?= htmlspecialchars($comment->getCreatedAt()) ?></p>

    <p>
        <a href="index.php?c=Post&a=ver&id=<?= $comment->getPostId() ?>">Ver post relacionado</a>
    </p>

    <?php if (
        isset($_SESSION['user_id']) &&
        (
            $_SESSION['user_id'] == $comment->getUserId() ||
            $_SESSION['rol_id'] == '1'
        )
    ): ?>
        <form action="index.php?c=Comment&a=eliminar" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este comentario?');">
            <input type="hidden" name="post_id" value="<?= $comment->getPostId() ?>">
            <input type="hidden" name="id" value="<?= $comment->getId() ?>">
            <button type="submit">Eliminar comentario</button>
        </form>
    <?php endif; ?>

<?php else: ?>
    <p>Comentario no encontrado.</p>
<?php endif; ?>
