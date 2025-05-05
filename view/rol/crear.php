<div class="container">
    <h2>Crear nuevo Rol</h2>
    <form action="index.php?c=Rol&a=guardar" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del Rol</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?c=Rol&a=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
