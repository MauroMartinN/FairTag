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
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 3) {
                echo '<p class="error">'.htmlspecialchars($mensaje).'</p>';
            }
            ?>
            <input type="file" name="image" accept="image/*" required>
        </div>



        <div>
            <label for="google_link">Enlace de Google Maps:</label>
            <?php
            if (isset($_GET['error']) && $_GET['error'] != 3) {
                echo '<p class="error">'.htmlspecialchars($mensaje).'</p>';
            }
            ?>
            <input type="text" name="google_link" required>
        </div>
        <div>
            <div>
                <select name="type" required id="select">
                </select>
            </div>

            <button type="submit">Guardar</button>
        </div>
    </form>
</div>

<script>

    let select = document.getElementById('select');
    let tipos = <?= json_encode(array_map(fn($tipo) => [
        'id' => $tipo->getId(),
        'name' => $tipo->getNombre()
    ], $tipos)) ?>;

    tipos.forEach(function(tipo) {
        let option = document.createElement('option');
        option.value = tipo.id;
        option.textContent = tipo.name;
        select.appendChild(option);
    });
</script>