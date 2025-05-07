<h2>Lista de posts</h2>

<a href="index.php?c=Post&a=crear">Crear nuevo post</a>

<?php if (empty($posts)): ?>
    <p>Aún no hay posts</p>
<?php else: ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <h3>
                    <a href="index.php?c=Post&a=ver&id=<?= $post->getId() ?>">
                        <?= htmlspecialchars($post->getTitle()) ?>
                    </a>
                </h3>
                <p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>
                <img src="uploads/<?= htmlspecialchars($post->getImage()) ?>" alt="Imagen del post" width="200">
                <p>Publicado el: <?= $post->getCreatedAt() ?></p>
                <p><a href="<?= htmlspecialchars($post->getGoogleLink()) ?>" target="_blank">Ver en Google Maps</a></p>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->getUserId()): ?>
                    <a href="index.php?c=Post&a=eliminar&id=<?= $post->getId() ?>" onclick="return confirm('¿Seguro que quieres eliminar este post?')">Eliminar</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
