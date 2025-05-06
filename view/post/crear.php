<h2>Crear nuevo post</h2>

<form action="index.php?c=Post&a=guardar" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Título:</label>
        <input type="text" name="title" required>
    </div>

    <div>
        <label for="content">Contenido:</label>
        <textarea name="content" rows="5" required></textarea>
    </div>

    <div>
        <label for="image">Imagen:</label>
        <input type="file" name="image" accept="image/*" required>
    </div>

    <div>
        <label for="google_link">Enlace de Google Maps:</label>
        <input type="text" name="google_link" required>
    </div>

    <div>
        <button type="submit">Guardar</button>
    </div>
</form>
