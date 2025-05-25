<div class="post-container">
    <h2><?php echo htmlspecialchars($post->getTitle()); ?></h2>
    <p><strong>Autor:</strong> <?php echo $autor; ?></p>
    <p><strong>Contenido:</strong> <?php echo nl2br(htmlspecialchars($post->getContent())); ?></p>
    <?php if ($post->getImage()): ?>
        <img src="postsImg/<?php echo htmlspecialchars($post->getImage()); ?>" alt="Imagen del post"
            style="max-width: 100%; height: auto;">
    <?php endif; ?>
    <p><strong>Tipo:</strong> <?php echo $post->getType(); ?></p>
    <p><strong>Publicado:</strong> <?php echo $post->getCreatedAt(); ?></p>
    <p><strong>Ubicación:</strong> <a href="<?php echo htmlspecialchars($post->getGoogleLink()); ?>" target="_blank">Ver
            en Google Maps</a></p>
    <p><strong>Favoritos:</strong> <?= $this->model->obtenerNumeroFavoritosPorPostId($post->getId()) ?></p>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>
        <form action="index.php?c=User&a=alternarPostFavorito" method="post">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getId()) ?>">
            <button type="submit" class="favorite-btn">
                <?= $yaEsFavorito ? '❤️' : '🤍' ?>
            </button>
        </form>
        </p>
    <?php endif; ?>


    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->getUserId()): ?>
        <p>
        <form action="index.php?c=Post&a=eliminar" method="post"
            onsubmit="return confirm('¿Seguro que quieres eliminar este post?');">
            <input type="hidden" name="id" value="<?= htmlspecialchars($post->getId()) ?>">
            <button type="submit">Eliminar post</button>
        </form>

        </p>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $post->getUserId()): ?>
        <p>
            <button class="boton1" onclick="abrirModalPost(<?= $post->getId() ?>)">Denunciar post</button>
        </p>
    <?php endif; ?>


    <div id="denunciaPost">
        <div>
            <h4>Denunciar post</h4>
            <form method="POST" action="index.php?c=post&a=denunciar">
                <input type="hidden" name="post_id" id="postIdInput">
                <textarea name="motivo" placeholder="Motivo de la denuncia" required></textarea>
                <br><br>
                <button type="submit">Enviar denuncia</button>
                <button type="button" onclick="cerrarModalPost()">Cancelar</button>
            </form>
        </div>
    </div>


    <script>
        function abrirModalPost(id) {
            document.getElementById('postIdInput').value = id;
            document.getElementById('denunciaPost').style.display = 'block';
        }

        function cerrarModalPost() {
            document.getElementById('denunciaPost').style.display = 'none';
        }
    </script>
</div>