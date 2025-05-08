<h2><?php echo htmlspecialchars($post->getTitle()); ?></h2>

<p><strong>País:</strong> <?php echo htmlspecialchars($post->getCountry()); ?></p>
<p><strong>Contenido:</strong> <?php echo nl2br(htmlspecialchars($post->getContent())); ?></p>
<?php if ($post->getImage()): ?>
    <img src="postsImg/<?php echo htmlspecialchars($post->getImage()); ?>" alt="Imagen del post" style="max-width: 100%; height: auto;">
<?php endif; ?>
<p><strong>Publicado:</strong> <?php echo $post->getCreatedAt(); ?></p>
<p><strong>Ubicación:</strong> <a href="<?php echo htmlspecialchars($post->getGoogleLink()); ?>" target="_blank">Ver en Google Maps</a></p>

<hr>