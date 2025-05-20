<h3>Comentarios</h3>
<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <?php

                $userId = $comment->getUserId();
                $user = $userDAO->obtenerPorId($userId);
                $userName = $user->getName();
                $userImage = $user->getImage();
                
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
                    <form method="POST" action="index.php?c=Comment&a=eliminar" onsubmit="return confirm('¿Seguro que quieres eliminar este comentario?')" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $comment->getId() ?>">
                        <input type="hidden" name="post_id" value="<?= $postId ?>">
                        <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; padding:0;">
                            Eliminar
                        </button>
                    </form>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $comment->getUserId()): ?>
                    <button onclick="abrirModalComment(<?= $comment->getId() ?>)">Denunciar</button>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        
    </ul>
<?php else: ?>
    <p>No hay comentarios todavía.</p>
<?php endif; ?>


<div id="denunciaComment" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:999;">
    <div style="background:#fff; padding:20px; width:300px; margin:100px auto; border-radius:8px; position:relative;">
        <h4>Denunciar comentario</h4>
        <form method="POST" action="index.php?c=comment&a=denunciar">
            <input type="hidden" name="comentario_id" id="comentarioIdInput">
            <input type="hidden" name="post_id" value="<?= $postId ?>">
            <textarea name="motivo" placeholder="Motivo de la denuncia" required style="width:100%; height:80px;"></textarea>
            <br><br>
            <button type="submit">Enviar denuncia</button>
            <button type="button" onclick="cerrarModalComment()">Cancelar</button>
        </form>
    </div>
</div>


<script>
    function abrirModalComment(id) {
        document.getElementById('comentarioIdInput').value = id;
        document.getElementById('denunciaComment').style.display = 'block';
    }

    function cerrarModalComment() {
        document.getElementById('denunciaComment').style.display = 'none';
    }
</script>
