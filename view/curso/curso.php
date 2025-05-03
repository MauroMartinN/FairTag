<h1 class="page-header">Cursos</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Curso&a=editar">Nuevo curso</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Horas</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->model->listar() as $r): ?>
            <tr>
                <td><?php echo $r->getNombre(); ?></td>
                <td><?php echo $r->getHoras(); ?></td>
                <td>
                    <a href="?c=curso&a=editar&id=<?php echo $r->getId(); ?>">Editar</a>
                </td>
                <td>
                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Curso&a=eliminar&id=<?php echo $r->getId(); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
