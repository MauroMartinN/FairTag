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
        isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $comment->getUserId() || $_SESSION['rol_id'] == '2')
    ): ?>

        <form id="delete-comment-form" action="index.php?c=Comment&a=eliminar" method="POST">
            <input type="hidden" name="post_id" value="<?= $comment->getPostId() ?>">
            <input type="hidden" name="id" value="<?= $comment->getId() ?>">
            <button type="button" id="delete-comment-btn">Eliminar comentario</button>
        </form>

    <?php endif; ?>

<?php else: ?>
    <p>Comentario no encontrado.</p>
<?php endif; ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById("delete-comment-btn");
        const form = document.getElementById("delete-comment-form");

        btn.addEventListener("click", function () {
            if (confirm("¿Estás seguro de que quieres eliminar este comentario1?")) {
                form.submit();
            }
        });
    });
</script>