<h1 class="page-header">Alumnos</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Alumno&a=editar">Nuevo alumno</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th style="width:120px;">Sexo</th>
            <th style="width:120px;">Nacimiento</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->listar() as $r): ?>
        <tr>
            <td><?php echo $r->getNombre(); ?></td>
            <td><?php echo $r->getApellido(); ?></td>
            <td><?php echo $r->getCorreo(); ?></td>
            <td><?php echo $r->getSexo() == 1 ? 'Hombre' : 'Mujer'; ?></td>
            <td><?php echo $r->getFechaNacimiento(); ?></td>
            <td>
                <a href="?c=Alumno&a=editar&id=<?php echo $r->getId(); ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Alumno&a=eliminar&id=<?php echo $r->getId(); ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
