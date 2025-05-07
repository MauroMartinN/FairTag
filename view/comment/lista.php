<h3>Comentarios</h3>
<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <p><strong>Publicado el:</strong> <?= htmlspecialchars($comment->getCreatedAt()) ?></p>
                <p><strong>Autor:</strong> <?= htmlspecialchars($comment->getUserName()) ?></p>
                <?= nl2br(htmlspecialchars($comment->getContent())) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay comentarios todavía.</p>
<?php endif; ?>
