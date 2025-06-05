<div class="comentarios-section">
    <h3>Comentarios</h3>
    <ul id="commentsList"></ul>

    <div id="denunciaComment" class="modal-denuncia">
        <div class="modal-content">
            <h4>Denunciar comentario</h4>
            <form method="POST" action="index.php?c=comment&a=denunciar">
                <input type="hidden" name="comentario_id" id="comentarioIdInput">
                <input type="hidden" name="post_id" value="<?= $postId ?>">
                <textarea name="motivo" placeholder="Motivo de la denuncia" required></textarea>
                <br><br>
                <button type="submit">Enviar denuncia</button>
                <button type="button" onclick="cerrarModalComment()">Cancelar</button>
            </form>
        </div>
    </div>
</div>


<script>
    let comentariosData = <?= json_encode(array_map(function ($comment) use ($userDAO) {
        $user = $userDAO->obtenerPorId($comment->getUserId());
        $createdAt = new DateTime($comment->getCreatedAt());
        $now = new DateTime();
        $interval = $now->diff($createdAt);
        $timeAgo = "";
        if ($interval->y > 0) {
            $timeAgo = $interval->y . " año" . ($interval->y > 1 ? "s" : "");
        } elseif ($interval->m > 0) {
            $timeAgo = $interval->m . " mes" . ($interval->m > 1 ? "es" : "");
        } elseif ($interval->d > 0) {
            $timeAgo = $interval->d . " día" . ($interval->d > 1 ? "s" : "");
        } elseif ($interval->h > 0) {
            $timeAgo = $interval->h . " hora" . ($interval->h > 1 ? "s" : "");
        } elseif ($interval->i > 0) {
            $timeAgo = $interval->i . " minuto" . ($interval->i > 1 ? "s" : "");
        } else {
            $timeAgo = $interval->s . " segundo" . ($interval->s > 1 ? "s" : "");
        }
        return [
            'id' => $comment->getId(),
            'userId' => $comment->getUserId(),
            'userName' => $user->getName(),
            'userImage' => $user->getImage(),
            'timeAgo' => $timeAgo,
            'content' => htmlspecialchars($comment->getContent()),
        ];
    }, $comments)) ?>;

    let userSessionId = <?= isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 'null' ?>;
    let postId = <?= $postId ?>;
</script>

<script>
    function abrirModalComment(id) {
        document.getElementById('comentarioIdInput').value = id;
        document.getElementById('denunciaComment').style.display = 'block';
    }
    function cerrarModalComment() {
        document.getElementById('denunciaComment').style.display = 'none';
    }

    function crearComentarioHTML(comment) {
        let li = document.createElement('li');

        let img = document.createElement('img');
        img.src = `userImg/${comment.userImage}`;
        img.alt = 'Imagen de usuario';

        let infoDiv = document.createElement('div');
        infoDiv.className = 'comment-info';

        let topRow = document.createElement('div');
        topRow.className = 'comment-top-row';

        let authorP = document.createElement('p');
        authorP.className = 'comment-author';
        authorP.textContent = comment.userName;

        let timeP = document.createElement('p');
        timeP.className = 'comment-time';
        timeP.textContent = comment.timeAgo;

        topRow.appendChild(authorP);
        topRow.appendChild(timeP);

        let contentP = document.createElement('p');
        contentP.className = 'comment-content';
        contentP.innerHTML = comment.content;

        infoDiv.appendChild(topRow);
        infoDiv.appendChild(contentP);

        li.appendChild(img);
        li.appendChild(infoDiv);

        let actionsDiv = document.createElement('div');
        actionsDiv.classList.add('actions');

        if (userSessionId === comment.userId) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'index.php?c=Comment&a=eliminar';
            form.onsubmit = () => confirm('¿Seguro que quieres eliminar este comentario?');

            let inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'id';
            inputId.value = comment.id;

            let inputPostId = document.createElement('input');
            inputPostId.type = 'hidden';
            inputPostId.name = 'post_id';
            inputPostId.value = postId;

            let btnEliminar = document.createElement('button');
            btnEliminar.type = 'submit';
            btnEliminar.textContent = 'Eliminar';

            form.appendChild(inputId);
            form.appendChild(inputPostId);
            form.appendChild(btnEliminar);

            actionsDiv.appendChild(form);
        } else if (userSessionId !== null) {
            let btnDenunciar = document.createElement('button');
            btnDenunciar.textContent = 'Denunciar';
            btnDenunciar.onclick = () => abrirModalComment(comment.id);
            actionsDiv.appendChild(btnDenunciar);
        }

        li.appendChild(actionsDiv);

        return li;
    }


    function renderizarComentarios() {
        let ul = document.getElementById('commentsList');
        ul.innerHTML = '';
        if (comentariosData.length === 0) {
            ul.innerHTML = '<p>No hay comentarios todavía.</p>';
            return;
        }
        comentariosData.forEach(comment => {
            ul.appendChild(crearComentarioHTML(comment));
        });
    }

    renderizarComentarios();
</script>