<?php
require_once 'entidades/post.php';

class PostDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $post = new Post();
            $post->setId($data['id']);
            $post->setTitle($data['title']);
            $post->setContent($data['content']);
            $post->setImage($data['image']);
            $post->setCreatedAt($data['created_at']);
            $post->setGoogleLink($data['google_link']);
            $post->setUserId($data['user_id']);
            $post->setCountry($data['country']);
            $post->setType($data['tipo_post_id']);
            return $post;
        }

        return null;
    }

    public function obtenerPorUsuarioId(int $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($data as $row) {
            $post = new Post();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setImage($row['image']);
            $post->setCreatedAt($row['created_at']);
            $post->setGoogleLink($row['google_link']);
            $post->setCountry($row['country']);
            $post->setType($row['tipo_post_id']);
            $posts[] = $post;
        }

        return $posts;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($data as $row) {
            $post = new Post();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setImage($row['image']);
            $post->setCreatedAt($row['created_at']);
            $post->setGoogleLink($row['google_link']);
            $post->setUserId($row['user_id']);
            $post->setCountry($row['country']);
            $post->setType($row['tipo_post_id']);

            $posts[] = $post;
        }

        return $posts;
    }

    public function guardar(Post $post) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO posts (title, content, image, created_at, google_link, user_id, country, latitude, longitude, tipo_post_id) 
            VALUES (:title, :content, :image, :created_at, :google_link, :user_id, :country, :latitude, :longitude, :tipo_post_id)"
        );
        $stmt->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'created_at' => $post->getCreatedAt(),
            'google_link' => $post->getGoogleLink(),
            'user_id' => $post->getUserId(),
            'country' => $post->getCountry(),
            'latitude' => $post->getLatitude(),
            'longitude' => $post->getLongitude(),
            'tipo_post_id' => $post->getType()
        ]);
    }

    public function eliminar(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function obtenerFavoritosPorUsuarioId(int $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id IN (SELECT post_id FROM post_favoritos WHERE user_id = ?)");
        $stmt->execute([$user_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($data as $row) {
            $post = new Post();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setImage($row['image']);
            $post->setCreatedAt($row['created_at']);
            $post->setGoogleLink($row['google_link']);
            $post->setUserId($row['user_id']);
            $post->setCountry($row['country']);
            $post->setType($row['tipo_post_id']);
            $posts[] = $post;
        }

        return $posts;
    }

    public function guardarPostFavorito(int $user_id, int $post_id) {
        $stmt = $this->pdo->prepare("INSERT INTO post_favoritos (user_id, post_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $post_id]);
    }

    public function obtenerNumeroFavoritosPorPostId(int $post_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM post_favoritos WHERE post_id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetchColumn();
    }

    public function obtenerPostPorCoordinadas(float $latitude, float $longitude) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE latitude = ? AND longitude = ?");
        $stmt->execute([$latitude, $longitude]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return true;
        }

        return false;
    }
}