<h2><?php echo htmlspecialchars($post->getTitle()); ?></h2>
<p><strong>Autor:</strong> <?php echo $autor; ?></p>
<p><strong>Contenido:</strong> <?php echo nl2br(htmlspecialchars($post->getContent())); ?></p>
<?php if ($post->getImage()): ?>
    <img src="postsImg/<?php echo htmlspecialchars($post->getImage()); ?>" alt="Imagen del post" style="max-width: 100%; height: auto;">
<?php endif; ?>
<p><strong>Tipo:</strong> <?php echo $post->getType(); ?></p>
<p><strong>Publicado:</strong> <?php echo $post->getCreatedAt(); ?></p>
<p><strong>Ubicación:</strong> <a href="<?php echo htmlspecialchars($post->getGoogleLink()); ?>" target="_blank">Ver en Google Maps</a></p>

<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->getUserId()): ?>
    <p>
        <a href="index.php?c=Post&a=eliminar&id=<?php echo $post->getId(); ?>" onclick="return confirm('¿Seguro que quieres eliminar este post?')">Eliminar post</a>
    </p>
<?php endif; ?>