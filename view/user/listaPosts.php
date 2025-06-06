<?php
$postsData = [];

if (!empty($posts)) {
    foreach ($posts as $post) {
        $postsData[] = [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'createdAt' => (new DateTime($post->getCreatedAt()))->format('d/m/Y H:i')
        ];
    }
}
?>

<script>
    const posts = <?= json_encode($postsData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>


<div id="contenedor-principal-notis">
  <ul id="lista-notis">
  </ul>
</div>

<script>
  let lista = document.getElementById('lista-notis');

  if (posts.length > 0) {
    posts.forEach(post => {
      let li = document.createElement('li');

      li.innerHTML = `
        <strong>${post.title}</strong><br>
        <img src="postsImg/${post.image}" alt="Imagen del post" style="max-width: 200px; height: auto;"><br>
        <small>Publicado el ${post.createdAt}</small><br>
        <a href="index.php?c=Post&a=ver&id=${post.id}">Ver</a>
      `;

      lista.appendChild(li);
    });
  } else {
    lista.innerHTML = '<p>No hay posts.</p>';
  }
</script>
