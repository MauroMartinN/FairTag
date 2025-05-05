<?php
require_once 'entidades/rol.php';

class RolDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $rol = new Rol();
            $rol->setId($data['id']);
            $rol->setNombre($data['nombre']);
            return $rol;
        }

        return null;
    }

    
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM roles");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roles = [];
        foreach ($data as $row) {
            $rol = new Rol();
            $rol->setId($row['id']);
            $rol->setNombre($row['nombre']);
            $roles[] = $rol;
        }

        return $roles;
    }

    public function obtenerPorNombre(string $nombre) {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE nombre = :nombre");
        $stmt->execute(['nombre' => $nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $rol = new Rol();
            $rol->setId($data['id']);
            $rol->setNombre($data['nombre']);
            return $rol;
        }

        return null;
    }

    public function save(Rol $rol) {
        $stmt = $this->pdo->prepare("INSERT INTO roles (nombre) VALUES (:nombre)");
        $stmt->execute(['nombre' => $rol->getNombre()]);
    }

    public function update(Rol $rol) {
        $stmt = $this->pdo->prepare("UPDATE roles SET nombre = :nombre WHERE id = :id");
        $stmt->execute([
            'nombre' => $rol->getNombre(),
            'id' => $rol->getId()
        ]);
    }

    public function delete(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM roles WHERE id = ?");
        $stmt->execute([$id]);
    }

}