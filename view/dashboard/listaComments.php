<script>
    const comentarios = <?= json_encode(array_map(function($comment) {
        return [
            'id' => htmlspecialchars($comment->getId()),
            'content' => htmlspecialchars($comment->getContent()),
            'createdAt' => htmlspecialchars($comment->getCreatedAt()),
            'postId' => htmlspecialchars($comment->getPostId()),
        ];
    }, $comments)) ?>;
</script>

<h2 class="base">Comentarios del Usuario</h2>
<ul id="lista-comentarios"></ul>
<div id="paginacion-comentarios" style="text-align:center; margin-top: 15px;"></div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const lista = document.getElementById("lista-comentarios");
    const paginacionDiv = document.getElementById("paginacion-comentarios");
    const itemsPorPagina = 10;
    let paginaActual = 1;

    const header = document.createElement("li");
    header.classList.add("header-row");
    header.innerHTML = `
        <div class="col-id">ID</div>
        <div class="col-content">Contenido</div>
        <div class="col-createdAt">Fecha</div>
        <div class="col-postId">ID del Post</div>
        <div class="col-acciones">Acciones</div>
    `;
    lista.appendChild(header);

    function mostrarPagina(pagina) {
        paginaActual = pagina;

        Array.from(lista.querySelectorAll("li:not(.header-row)")).forEach(li => li.remove());

        const start = (pagina - 1) * itemsPorPagina;
        const end = start + itemsPorPagina;
        const comentariosPagina = comentarios.slice(start, end);

        comentariosPagina.forEach(c => {
            const li = document.createElement("li");
            li.innerHTML = `
                <div class="col-id">${c.id}</div>
                <div class="col-content">${c.content.replace(/\n/g, '<br>')}</div>
                <div class="col-createdAt">${c.createdAt}</div>
                <div class="col-postId">${c.postId}</div>
                <div class="col-acciones">
                    <form action="index.php?c=Comment&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este comentario?');" style="display:inline;">
                        <input type="hidden" name="id" value="${c.id}">
                        <input type="hidden" name="post_id" value="${c.postId}">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            `;
            lista.appendChild(li);
        });

        actualizarPaginacion();
    }

    function actualizarPaginacion() {
        paginacionDiv.innerHTML = "";
        const totalPaginas = Math.ceil(comentarios.length / itemsPorPagina);

        const btnPrev = document.createElement("button");
        btnPrev.textContent = "Anterior";
        btnPrev.disabled = (paginaActual === 1);
        btnPrev.style.margin = "0 5px";
        btnPrev.onclick = () => mostrarPagina(paginaActual - 1);
        paginacionDiv.appendChild(btnPrev);

        for (let i = 1; i <= totalPaginas; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.style.margin = "0 3px";
            if (i === paginaActual) {
                btn.style.fontWeight = "bold";
                btn.disabled = true;
            }
            btn.onclick = () => mostrarPagina(i);
            paginacionDiv.appendChild(btn);
        }

        const btnNext = document.createElement("button");
        btnNext.textContent = "Siguiente";
        btnNext.disabled = (paginaActual === totalPaginas);
        btnNext.style.margin = "0 5px";
        btnNext.onclick = () => mostrarPagina(paginaActual + 1);
        paginacionDiv.appendChild(btnNext);
    }

    mostrarPagina(1);
});
</script>

