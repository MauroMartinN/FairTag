<div class="container">
    <h2 class="base">Crear nuevo post</h2>

    <form action="index.php?c=Post&a=guardar" method="post" enctype="multipart/form-data" class="form-post">
        <div>
            <label for="title">Título:</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label for="content">Contenido:</label><br>
            <textarea name="content" rows="5" required></textarea>
        </div>

        <div>
            <label for="image">Imagen:</label>
            <input type="file" name="image" accept="image/*" required>
        </div>



        <div>
            <label for="google_link">Enlace de Google Maps:</label>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p class="error">Error: El enlace de Google Maps no es válido.</p>';
            }
            ?>
            <input type="text" name="google_link" required>
        </div>
        <div>
            <div>
                <select name="type" required>
                    <option value="monumento">Monumento histórico</option>
                    <option value="museo">Museo</option>
                    <option value="playa">Playa</option>
                    <option value="montaña">Montaña / Sendero</option>
                    <option value="parque">Parque o espacio natural</option>
                    <option value="zona_comercial">Zona comercial / Mercado</option>
                    <option value="mirador">Mirador</option>
                    <option value="barrio_popular">Barrio pintoresco</option>
                    <option value="otro">Otro</option>
                </select>
            </div>

            <button type="submit">Guardar</button>
        </div>
    </form>
</div>