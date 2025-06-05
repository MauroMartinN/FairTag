<script>
    let notificaciones = <?= json_encode(array_map(function ($n) {
        return [
            'id' => $n->getId(),
            'mensaje' => $n->getMessage(),
            'leida' => $n->getIsRead(),
            'postId' => $n->getPostId()
        ];
    }, $notificaciones)); ?>;
</script>

<h2 class="base">Notificaciones</h2>

<div id="contenedor-principal-notis">
    <div id="acciones-globales-notis"></div>
    <ul id="lista-notis"></ul>
</div>

<script>
    let contenedor = document.getElementById('lista-notis');
    let acciones = document.getElementById('acciones-globales-notis');

    if (!notificaciones.length) {
        contenedor.innerHTML = '<p>No tienes notificaciones nuevas.</p>';
    } else {
        acciones.innerHTML = `
            <ul>
                <li><a href="index.php?c=notificacion&a=marcarTodasComoLeidas">Marcar todas como leídas</a></li>
                <li><a href="index.php?c=notificacion&a=eliminarTodas">Eliminar todas</a></li>
                <li><a href="index.php?c=notificacion&a=eliminarLeidas">Eliminar leídas</a></li>
            </ul>
        `;

        notificaciones.forEach(n => {
            let li = document.createElement('li');
            li.style.marginBottom = '10px';
            li.style.color = n.leida ? 'gray' : 'inherit';
            li.style.fontWeight = n.leida ? 'normal' : 'bold';

            li.innerHTML = `
                ${n.mensaje}
                <br>
                ${n.leida ? 'Leída' : 'No leída'}
                <br>
                <form action="index.php?c=notificacion&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar esta notificación?');">
                    <input type="hidden" name="id" value="${n.id}">
                    <button type="submit" class="btn-link">Eliminar</button>
                </form>
                <a href="index.php?c=Post&a=ver&id=${n.postId}">Ver post</a>
            `;
            contenedor.appendChild(li);
        });
    }
</script>