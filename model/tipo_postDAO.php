<?php
require_once 'entidades/tipo_post.php';

class TipoPostDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tipo_post WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $tipoPost = new TipoPost();
            $tipoPost->setId($data['id']);
            $tipoPost->setNombre($data['nombre']);
            return $tipoPost;
        }

        return null;
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM tipo_post");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tiposPost = [];
        foreach ($data as $row) {
            $tipoPost = new TipoPost();
            $tipoPost->setId($row['id']);
            $tipoPost->setNombre($row['nombre']);
            $tiposPost[] = $tipoPost;
        }

        return $tiposPost;
    }

    public function obtenerPorNombre(string $nombre) {
        $stmt = $this->pdo->prepare("SELECT * FROM tipo_post WHERE nombre = :nombre");
        $stmt->execute(['nombre' => $nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $tipoPost = new TipoPost();
            $tipoPost->setId($data['id']);
            $tipoPost->setNombre($data['nombre']);
            return $tipoPost;
        }

        return null;
    }

}