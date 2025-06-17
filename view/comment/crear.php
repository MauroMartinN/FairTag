<div class="comentarios-section">
    <h3>Crear Nuevo Comentario</h3>
    <form action="index.php?c=Comment&a=guardar" method="POST">

        <textarea name="content" id="content" placeholder="Escribe tu comentario..." required></textarea>

        <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id']; ?>">
        <input type="hidden" name="post_id" id="post_id" value="<?= $postId; ?>">

        <button type="submit">Crear Comentario</button>
    </form>
</div>