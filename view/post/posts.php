<h2>Lista de posts</h2>

<a href="index.php?c=Post&a=crear">Crear nuevo post</a>

<?php if (empty($posts)): ?>
    <p>Aún no hay posts</p>
<?php else: ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <?php 
                $userName = $userDAO->obtemerNombrePorId($post->getUserId()); 
            ?>
            <li>
                <h3>
                    <a href="index.php?c=Post&a=ver&id=<?= $post->getId() ?>">
                        <?= htmlspecialchars($post->getTitle()) ?>
                    </a>
                </h3>
                <p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>
                <img src="postsImg/<?= htmlspecialchars($post->getImage()) ?>" alt="Imagen del post" width="200">
                <p>Publicado el: <?= $post->getCreatedAt() ?></p>
                <p>Por: <?= $userName ?></p>

                <p>Ubicación: <?= htmlspecialchars($post->getCountry()) ?></p>
                <p><a href="<?= htmlspecialchars($post->getGoogleLink()) ?>" target="_blank">Ver en Google Maps</a></p>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->getUserId()): ?>
                    <form action="index.php?c=Post&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este post?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($post->getId()) ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                <?php endif; ?>

            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
