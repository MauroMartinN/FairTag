<script>
    let usuarios = <?= json_encode(array_map(function($user) {
        return [
            'id' => htmlspecialchars($user->getId()),
            'name' => htmlspecialchars($user->getName()),
            'email' => htmlspecialchars($user->getEmail()),
            'rol' => match ($user->getRolId()) {
                1 => "Administrador",
                2 => "Usuario",
                3 => "Usuario Verificado",
                default => "Desconocido",
            },
            'image' => htmlspecialchars($user->getImage())
        ];
    }, $users)) ?>;
</script>

<h2 class="base">Listado de Usuarios</h2>
<ul id="lista-usuarios"></ul>
<div id="paginacion" style="text-align:center; margin-top: 15px;"></div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let lista = document.getElementById("lista-usuarios");
    let paginacionDiv = document.getElementById("paginacion");
    let itemsPorPagina = 5;
    let paginaActual = 1;

    let header = document.createElement("li");
    header.classList.add("header-row");
    header.innerHTML = `
        <div class="col-id">ID</div>
        <div class="col-nombre">Nombre</div>
        <div class="col-email">Email</div>
        <div class="col-rol">Rol</div>
        <div class="col-imagen">Imagen</div>
        <div class="col-acciones">Acciones</div>
    `;
    lista.appendChild(header);

    function mostrarPagina(pagina) {
        paginaActual = pagina;

        Array.from(lista.querySelectorAll("li:not(.header-row)")).forEach(li => li.remove());

        let start = (pagina - 1) * itemsPorPagina;
        let end = start + itemsPorPagina;

        let usuariosPagina = usuarios.slice(start, end);

        usuariosPagina.forEach(usuario => {
            let li = document.createElement("li");
            li.innerHTML = `
                <div class="col-id">${usuario.id}</div>
                <div class="col-nombre">${usuario.name}</div>
                <div class="col-email">${usuario.email}</div>
                <div class="col-rol">${usuario.rol}</div>
                <div class="col-imagen"><img src="userImg/${usuario.image}" alt="Imagen usuario"></div>
                <div class="col-acciones">
                    <a href="index.php?c=Post&a=listarPorUserId&id=${usuario.id}">Ver Posts</a> |
                    <a href="index.php?c=Comment&a=listarPorUserId&id=${usuario.id}">Ver Comentarios</a> |
                    <form action="index.php?c=User&a=eliminar" method="post" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');" style="display:inline;">
                        <input type="hidden" name="id" value="${usuario.id}">
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
        let totalPaginas = Math.ceil(usuarios.length / itemsPorPagina);

        let btnPrev = document.createElement("button");
        btnPrev.textContent = "Anterior";
        btnPrev.disabled = (paginaActual === 1);
        btnPrev.style.margin = "0 5px";
        btnPrev.onclick = () => mostrarPagina(paginaActual - 1);
        paginacionDiv.appendChild(btnPrev);

        for (let i = 1; i <= totalPaginas; i++) {
            let btn = document.createElement("button");
            btn.textContent = i;
            btn.style.margin = "0 3px";
            if (i === paginaActual) {
                btn.style.fontWeight = "bold";
                btn.disabled = true;
            }
            btn.onclick = () => mostrarPagina(i);
            paginacionDiv.appendChild(btn);
        }

        let btnNext = document.createElement("button");
        btnNext.textContent = "Siguiente";
        btnNext.disabled = (paginaActual === totalPaginas);
        btnNext.style.margin = "0 5px";
        btnNext.onclick = () => mostrarPagina(paginaActual + 1);
        paginacionDiv.appendChild(btnNext);
    }

    mostrarPagina(1);
});
</script>
