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

    public function obtenerPorEmail(string $email): ?User {
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
            return $user;
        }
        return null;
    }

    public function registrar(User $user): void {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, rol_id) VALUES (:name, :email, :password, :rol_id)");
        $stmt->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'rol_id' => $user->getRolId()
        ]);
    }

    public function obtenerPorId(int $id): ?User {
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
            return $user;
        }

        return null;
    }
}
