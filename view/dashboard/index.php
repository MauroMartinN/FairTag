<style>
    :root {
        --verde-principal: #28a745;
        --verde-claro: #8fd19e;
        --verde-oscuro: #1e7e34;
        --gris-claro: #f8f9fa;
        --gris-oscuro: #495057;
        --blanco: #ffffff;
        --negro: #212529;
    }

    .admin-panel {
        max-width: 700px;
        width: calc(100% - 40px);
        margin: 40px auto;
        background: var(--gris-claro);
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 30px 40px;
        box-sizing: border-box;
        color: var(--negro);
        font-weight: 500;
    }

    .admin-panel p {
        font-size: 1.1rem;
        text-align: center;
        margin-bottom: 25px;
    }

    .admin-panel ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 0;
        margin: 0;
        align-items: center;
    }

    .admin-panel li a {
        display: inline-block;
        padding: 12px 24px;
        font-weight: 600;
        color: var(--verde-principal);
        background: var(--verde-claro);
        border-radius: 8px;
        border: 2px solid transparent;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(40, 167, 69, 0.2);
    }

    .admin-panel li a:hover {
        background: var(--verde-oscuro);
        color: var(--blanco);
        border-color: var(--verde-oscuro);
        box-shadow: 0 4px 10px rgba(30, 126, 52, 0.4);
    }
</style>

<h2 class="base">Panel de Administración</h2>

<div class="admin-panel">
    <p>Bienvenido al panel de administración. Aquí puedes gestionar los usuarios y las denuncias.</p>
    <ul>
        <li><a href="index.php?c=User&a=listar">Gestionar Usuarios</a></li>
        <li><a href="index.php?c=Denuncia&a=listarDenuncias">Ver Denuncias</li>
    </ul>
</div>

