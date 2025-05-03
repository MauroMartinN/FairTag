<h1 class="page-header">
    <?php 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
    <li>Cursos</li>
    <li class="active"><?php echo 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-registro" action="?c=Usuario&a=registrar" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" value="" class="form-control"  data-validacion-tipo="requerido|min:10" />
    </div>


    <div class="form-group">
        <label>Usuario</label>
        <input type="text" name="usuario" value="" class="form-control"  data-validacion-tipo="requerido|min:6" />
    </div>
    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="password" value="" class="form-control"  data-validacion-tipo="requerido|min:8" />
    </div>
    <div class="form-group">
        <label>Correo</label>
        <input type="text" name="email" value="" class="form-control"  data-validacion-tipo="requerido|email" />
    </div>
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Registrar</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#frm-registro").submit(function () {
            return $(this).validate();
        });
    })
</script>
