<?php
require_once 'entidades/user.php';

class UserDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorEmail(string $email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRolId($data['rol_id']);
            $user->setImage($data['image']);
            return $user;
        }
        return null;
    }

    public function registrar(User $user) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, rol_id) VALUES (:name, :email, :password, :rol_id)");
        $stmt->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'rol_id' => $user->getRolId()
        ]);
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRolId($data['rol_id']);
            $user->setImage($data['image']);
            return $user;
        }

        return null;
    }

    public function obtenerPorNombre(string $name) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$name]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRolId($data['rol_id']);
            $user->setImage($data['image']);
            return $user;
        }

        return null;
    }

    public function obtenerPorRolId(int $rol_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE rol_id = ?");
        $stmt->execute([$rol_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($data as $row) {
            $user = new User();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setRolId($row['rol_id']);
            $user->setImage($row['image']);
            $users[] = $user;
        }

        return $users;
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($data as $row) {
            $user = new User();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setRolId($row['rol_id']);
            $user->setImage($row['image']);
            $users[] = $user;
        }

        return $users;
    }

    public function actualizar(User $user) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name, rol_id = :rol_id, image = :image WHERE id = :id");
        $stmt->execute([
            'name' => $user->getName(),
            'rol_id' => $user->getRolId(),
            'image' => $user->getImage(),
            'id' => $user->getId()
        ]);
    }

    public function eliminar(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function obtemerNombrePorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT name FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $data['name'];
        }

        return null;
    }
}
