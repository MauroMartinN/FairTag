<h2><?php echo htmlspecialchars($post->getTitle()); ?></h2>
<p><strong>Autor:</strong> <?php echo $autor; ?></p>
<p><strong>Contenido:</strong> <?php echo nl2br(htmlspecialchars($post->getContent())); ?></p>
<?php if ($post->getImage()): ?>
    <img src="postsImg/<?php echo htmlspecialchars($post->getImage()); ?>" alt="Imagen del post" style="max-width: 100%; height: auto;">
<?php endif; ?>
<p><strong>Tipo:</strong> <?php echo $post->getType(); ?></p>
<p><strong>Publicado:</strong> <?php echo $post->getCreatedAt(); ?></p>
<p><strong>Ubicación:</strong> <a href="<?php echo htmlspecialchars($post->getGoogleLink()); ?>" target="_blank">Ver en Google Maps</a></p>
<p><strong>Favoritos:</strong> <?= $this->model->obtenerNumeroFavoritosPorPostId($post->getId()) ?></p>

<?php if (isset($_SESSION['user_id'])): ?>
    <p>
        <form action="index.php?c=User&a=alternarPostFavorito" method="post">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getId()) ?>">
            <button type="submit">
                <?= $yaEsFavorito ? 'Quitar de favoritos 💔' : 'Guardar como favorito ❤️' ?>
            </button>
        </form>
    </p>
<?php endif; ?>


<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->getUserId()): ?>
    <p>
        <form action="index.php?c=Post&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este post?');">
            <input type="hidden" name="id" value="<?= htmlspecialchars($post->getId()) ?>">
            <button type="submit">Eliminar post</button>
        </form>

    </p>
<?php endif; ?>
<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $post->getUserId()): ?>
    <p>
        <button onclick="abrirModalPost(<?= $post->getId() ?>)">Denunciar post</button>
    </p>
<?php endif; ?>


<div id="denunciaPost" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:999;">
    <div style="background:#fff; padding:20px; width:300px; margin:100px auto; border-radius:8px; position:relative;">
        <h4>Denunciar post</h4>
        <form method="POST" action="index.php?c=post&a=denunciar">
            <input type="hidden" name="post_id" id="postIdInput">
            <textarea name="motivo" placeholder="Motivo de la denuncia" required style="width:100%; height:80px;"></textarea>
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
