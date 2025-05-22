<h3>Publicaciones</h3>

<?php if (!empty($posts)): ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <strong><?= htmlspecialchars($post->getTitle()) ?></strong><br>
                <?= nl2br(htmlspecialchars($post->getContent())) ?><br>
                <img src="postsImg/<?php echo htmlspecialchars($post->getImage()); ?>" alt="Imagen del post" style="max-width: 200px; height: auto;">
                <small>Publicado el <?= (new DateTime($post->getCreatedAt()))->format('d/m/Y H:i') ?></small><br>
                <a href="index.php?c=Post&a=ver&id=<?= $post->getId() ?>">Ver</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay posts.</p>
<?php endif; ?>
