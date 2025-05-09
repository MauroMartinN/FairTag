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
        $stmt = $this->pdo->prepare("SELECT * FROM pais WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $pais = new Pais();
            $pais->setId($data['id']);
            $pais->setNombre($data['nombre']);
            return $pais;
        }

        return null;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM pais");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $paises = [];
        foreach ($data as $row) {
            $pais = new Pais();
            $pais->setId($row['id']);
            $pais->setNombre($row['nombre']);
            $paises[] = $pais;
        }

        return $paises;
    }

    public function obtenerPorNombre(string $nombre) {
        $stmt = $this->pdo->prepare("SELECT * FROM pais WHERE nombre = ?");
        $stmt->execute([$nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $pais = new Pais();
            $pais->setId($data['id']);
            $pais->setNombre($data['nombre']);
            return $pais;
        }

        return null;
    }

    public function agregar(Pais $pais) {
        $stmt = $this->pdo->prepare("INSERT INTO pais (nombre) VALUES (?)");
        $stmt->execute([$pais->getNombre()]);
    }

}
