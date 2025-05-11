<?php

require_once 'entidades/pais.php';

class PaisDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM countries WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $pais = new Pais();
            $pais->setId($data['id']);
            $pais->setName($data['name']);
            return $pais;
        }

        return null;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM countries");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $paises = [];
        foreach ($data as $row) {
            $pais = new Pais();
            $pais->setId($row['id']);
            $pais->setName($row['name']);
            $paises[] = $pais;
        }

        return $paises;
    }

    public function obtenerPorNombre(string $nombre) {
        $stmt = $this->pdo->prepare("SELECT * FROM countries WHERE name = ?");
        $stmt->execute([$nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $pais = new Pais();
            $pais->setId($data['id']);
            $pais->setName($data['name']);
            return $pais;
        }

        return null;
    }

    public function añadir(Pais $pais) {
        $stmt = $this->pdo->prepare("INSERT INTO countries (name) VALUES (?)");
        $stmt->execute([$pais->getName()]);
    }

    public function obtenerPosts(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE country_id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

}
