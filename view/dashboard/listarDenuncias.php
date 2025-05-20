<h2>Listado de Denuncias</h2>

<?php if (!empty($denuncias)): ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>ID del Contenido</th>
                <th>Motivo</th>
                <th>Usuario que denunció</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($denuncias as $denuncia): ?>
                <tr>
                    <td><?= htmlspecialchars($denuncia->getId()) ?></td>
                    <td><?= htmlspecialchars(ucfirst($denuncia->getTipo())) ?></td>
                    <td><?= htmlspecialchars($denuncia->getContenidoId()) ?></td>
                    <td><?= nl2br(htmlspecialchars($denuncia->getMotivo())) ?></td>
                    <td><?= htmlspecialchars($denuncia->getUsuarioId()) ?></td>
                    <td><?= htmlspecialchars($denuncia->getFecha()) ?></td>
                    <td>
                        <?php if ($denuncia->getTipo() === 'comentario'): ?>
                            <a href="index.php?c=Comment&a=ver&id=<?= $denuncia->getContenidoId() ?>">Ver Comentario</a>
                        <?php elseif ($denuncia->getTipo() === 'post'): ?>
                            <a href="index.php?c=Post&a=ver&id=<?= $denuncia->getContenidoId() ?>">Ver Post</a>
                        <?php endif; ?>
                        |
                        <form method="POST" action="index.php?c=Denuncia&a=eliminarDenunciasConContenidoId" onsubmit="return confirm('¿Eliminar esta denuncia?')" style="display:inline;">
                            <input type="hidden" name="contenidoId" value="<?= $denuncia->getContenidoId() ?>">
                            <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; padding:0;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay denuncias registradas.</p>
<?php endif; ?>
