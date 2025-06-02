<?php

require_once 'entidades/pais.php';
require_once 'entidades/post.php';

class PaisDAO
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM countries WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $pais = new Pais();
            $pais->setId($data['id']);
            $pais->setName($data['name']);
            $pais->setCoin($data['coin']);
            $pais->setConvertRate($data['convertRate']);
            $pais->setLastUpdate($data['lastUpdate']);
            return $pais;
        }

        return null;
    }

    public function obtenerTodos()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM countries");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $paises = [];
        foreach ($data as $row) {
            $pais = new Pais();
            $pais->setId($row['id']);
            $pais->setName($row['name']);
            $pais->setCoin($data['coin']);
            $pais->setConvertRate($data['convertRate']);
            $pais->setLastUpdate($data['lastUpdate']);
            $paises[] = $pais;
        }

        return $paises;
    }

    public function obtenerPorNombre(string $nombre)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM countries WHERE name = ?");
        $stmt->execute([$nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $pais = new Pais();
            $pais->setId($data['id']);
            $pais->setName($data['name']);
            $pais->setCoin($data['coin']);
            $pais->setConvertRate($data['convertRate']);
            $pais->setLastUpdate($data['lastUpdate']);
            return $pais;
        }

        return null;
    }

    public function obtenerPosts(int $id, string $type = null)
    {
        if ($type) {
            $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE country = ? AND type = ?");
            $stmt->execute([$id, $type]);
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE country = ?");
            $stmt->execute([$id]);
        }

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
            $post->setLatitude($row['latitude']);
            $post->setLongitude($row['longitude']);
            $post->setCountry($row['country']);
            $post->setUserId($row['user_id']);
            $post->setType($row['type']);
            $posts[] = $post;
        }

        return $posts;
    }

    public function updateRate(int $id, string $rate)
    {
        $now = date('Y-m-d H:i:s');

        $stmt = $this->pdo->prepare("UPDATE countries SET convertRate = ?, lastUpdate = ? WHERE id = ?");
        return $stmt->execute([$rate, $now, $id]);
    }



}
