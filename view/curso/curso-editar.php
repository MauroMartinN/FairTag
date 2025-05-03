<h1 class="page-header">
    <?php echo $curso->getId() != null ? $curso->getNombre() : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Curso">Cursos</a></li>
  <li class="active"><?php echo $curso->getId() != null ? $curso->getNombre() : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-curso" action="?c=Curso&a=guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $curso->getId(); ?>" />
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombre" value="<?php echo $curso->getNombre(); ?>" class="form-control" placeholder="Ingrese el nombre del curso" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Horas</label>
        <input type="text" name="Horas" value="<?php echo $curso->getHoras(); ?>" class="form-control" placeholder="Ingrese el número de horas" data-validacion-tipo="requerido|numero|numHoras" />
    </div>
    
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-curso").submit(function(){
            return $(this).validate();
        });
    })
</script>