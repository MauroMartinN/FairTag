<script>
const denuncias = <?= json_encode(array_map(function($denuncia) {
    return [
        'id' => htmlspecialchars($denuncia->getId()),
        'tipo' => htmlspecialchars($denuncia->getTipo()),
        'contenidoId' => htmlspecialchars($denuncia->getContenidoId()),
        'motivo' => nl2br(htmlspecialchars($denuncia->getMotivo())),
        'usuarioId' => htmlspecialchars($denuncia->getUsuarioId()),
        'fecha' => htmlspecialchars($denuncia->getFecha())
    ];
}, $denuncias)) ?>;
</script>

<h2 class="base">Listado de Denuncias</h2>
<ul id="lista-denuncias"></ul>
<div id="paginacion-denuncias" style="text-align:center; margin-top: 15px;"></div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const lista = document.getElementById("lista-denuncias");
    const paginacionDiv = document.getElementById("paginacion-denuncias");
    const itemsPorPagina = 10;
    let paginaActual = 1;

    const header = document.createElement("li");
    header.classList.add("header-row");
    header.innerHTML = `
        <div class="col-id">ID</div>
        <div class="col-tipo">Tipo</div>
        <div class="col-motivo">Motivo</div>
        <div class="col-usuario">Usuario</div>
        <div class="col-fecha">Fecha</div>
        <div class="col-acciones">Acciones</div>
    `;
    lista.appendChild(header);

    function mostrarPagina(pagina) {
        paginaActual = pagina;
        Array.from(lista.querySelectorAll("li:not(.header-row)")).forEach(li => li.remove());

        const start = (pagina - 1) * itemsPorPagina;
        const end = start + itemsPorPagina;
        const paginaDenuncias = denuncias.slice(start, end);

        paginaDenuncias.forEach(d => {
            const li = document.createElement("li");
            const enlaceVer = d.tipo === 'comentario'
                ? `index.php?c=Comment&a=ver&id=${d.contenidoId}`
                : `index.php?c=Post&a=ver&id=${d.contenidoId}`;

            li.innerHTML = `
                <div class="col-id">${d.id}</div>
                <div class="col-tipo">${d.tipo.charAt(0).toUpperCase() + d.tipo.slice(1)}</div>
                <div class="col-motivo">${d.motivo}</div>
                <div class="col-usuario">${d.usuarioId}</div>
                <div class="col-fecha">${d.fecha}</div>
                <div class="col-acciones">
                    <a href="${enlaceVer}">Ver ${d.tipo.charAt(0).toUpperCase() + d.tipo.slice(1)}</a> |
                    <form method="POST" action="index.php?c=Denuncia&a=eliminarDenunciasConContenidoId"
                          onsubmit="return confirm('¿Eliminar esta denuncia?')" style="display:inline;">
                        <input type="hidden" name="contenidoId" value="${d.contenidoId}">
                        <button type="submit" class="btn-link">Eliminar</button>
                    </form>
                </div>
            `;
            lista.appendChild(li);
        });

        actualizarPaginacion();
    }

    function actualizarPaginacion() {
        paginacionDiv.innerHTML = "";
        const totalPaginas = Math.ceil(denuncias.length / itemsPorPagina);

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
