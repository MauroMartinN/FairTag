<h3>Comentarios</h3>
<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <?php
                $createdAt = new DateTime($comment->getCreatedAt());
                $now = new DateTime();
                $interval = $now->diff($createdAt);

                $timeAgo = "";
                if ($interval->y > 0) {
                    $timeAgo = $interval->y . " año" . ($interval->y > 1 ? "s" : "");
                } elseif ($interval->m > 0) {
                    $timeAgo = $interval->m . " mes" . ($interval->m > 1 ? "es" : "");
                } elseif ($interval->d > 0) {
                    $timeAgo = $interval->d . " día" . ($interval->d > 1 ? "s" : "");
                } elseif ($interval->h > 0) {
                    $timeAgo = $interval->h . " hora" . ($interval->h > 1 ? "s" : "");
                } elseif ($interval->i > 0) {
                    $timeAgo = $interval->i . " minuto" . ($interval->i > 1 ? "s" : "");
                } else {
                    $timeAgo = $interval->s . " segundo" . ($interval->s > 1 ? "s" : "");
                }
            ?>

            <li>
                <p>Publicado hace: <?= htmlspecialchars($timeAgo) ?></p>
                <img src="userImg/<?= htmlspecialchars($userImage) ?>" alt="Imagen de usuario" width="100">
                <p>Autor: <?= $userName ?></p>
                <?= nl2br(htmlspecialchars($comment->getContent())) ?>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment->getUserId()): ?>
                    <a href="index.php?c=Comment&a=eliminar&id=<?= $comment->getId() ?>&post_id=<?= $postId ?>" onclick="return confirm('¿Seguro que quieres eliminar este comentario?')">Eliminar</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay comentarios todavía.</p>
<?php endif; ?>
