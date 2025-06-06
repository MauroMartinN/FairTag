<script>
    const posts = <?= json_encode(array_map(function($post) {
        return [
            'id' => htmlspecialchars($post->getId()),
            'title' => htmlspecialchars($post->getTitle()),
            'content' => nl2br(htmlspecialchars($post->getContent())),
            'createdAt' => htmlspecialchars($post->getCreatedAt()),
            'type' => htmlspecialchars($post->getType()),
            'image' => $post->getImage() ? 'postsImg/' . htmlspecialchars($post->getImage()) : null
        ];
    }, $posts)) ?>;
</script>

<h2 class="base">Posts del Usuario</h2>
<ul id="lista-posts"></ul>
<div id="paginacion-posts" style="text-align:center; margin-top: 15px;"></div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const lista = document.getElementById("lista-posts");
    const paginacionDiv = document.getElementById("paginacion-posts");
    const itemsPorPagina = 10;
    let paginaActual = 1;

    const header = document.createElement("li");
    header.classList.add("header-row");
    header.innerHTML = `
        <div class="col-postId">ID</div>
        <div class="col-nombre">Título</div>
        <div class="col-content">Contenido</div>
        <div class="col-createdAt">Fecha</div>
        <div class="col-rol">Tipo</div>
        <div class="col-imagen">Imagen</div>
        <div class="col-acciones">Acciones</div>
    `;
    lista.appendChild(header);

    function mostrarPagina(pagina) {
        paginaActual = pagina;

        Array.from(lista.querySelectorAll("li:not(.header-row)")).forEach(li => li.remove());

        const start = (pagina - 1) * itemsPorPagina;
        const end = start + itemsPorPagina;
        const postsPagina = posts.slice(start, end);

        postsPagina.forEach(p => {
            const li = document.createElement("li");
            li.innerHTML = `
                <div class="col-postId">${p.id}</div>
                <div class="col-nombre">${p.title}</div>
                <div class="col-content">${p.content}</div>
                <div class="col-createdAt">${p.createdAt}</div>
                <div class="col-rol">${p.type}</div>
                <div class="col-imagen">
                    ${p.image ? `<img src="${p.image}" alt="Imagen del post">` : "Sin imagen"}
                </div>
                <div class="col-acciones">
                    <a href="index.php?c=Post&a=ver&id=${p.id}">Ver</a>
                    <form action="index.php?c=Post&a=eliminar" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este post?');" style="display:inline;">
                        <input type="hidden" name="id" value="${p.id}">
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
        const totalPaginas = Math.ceil(posts.length / itemsPorPagina);

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
