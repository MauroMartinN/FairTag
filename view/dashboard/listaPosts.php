<h2>Posts del Usuario</h2>

<?php if (!empty($posts)): ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li style="margin-bottom: 25px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <p><strong>ID:</strong> <?= htmlspecialchars($post->getId()) ?></p>
                <p><strong>Título:</strong> <?= htmlspecialchars($post->getTitle()) ?></p>
                <p><strong>Contenido:</strong><br> <?= nl2br(htmlspecialchars($post->getContent())) ?></p>
                <p><strong>Fecha de Publicación:</strong> <?= htmlspecialchars($post->getCreatedAt()) ?></p>
                <p><strong>Tipo:</strong> <?= htmlspecialchars($post->getType()) ?></p>
                <?php if ($post->getImage()): ?>
                    <p><strong>Imagen:</strong><br>
                        <img src="postsImg/<?= htmlspecialchars($post->getImage()) ?>" alt="Imagen del post" style="max-width:200px;">
                    </p>
                <?php endif; ?>
                <p>
                    <a href="index.php?c=Post&a=ver&id=<?= $post->getId() ?>">Ver</a> |
                    <a href="index.php?c=Post&a=eliminar&id=<?= $post->getId() ?>" onclick="return confirm('¿Seguro que quieres eliminar este post?')">Eliminar</a>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron posts para este usuario.</p>
<?php endif; ?>
