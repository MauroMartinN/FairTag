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
            $user->setToken($data['token']);
            return $user;
        }
        return null;
    }

    public function registrar(User $user) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, rol_id, image, token) VALUES (:name, :email, :password, :rol_id, :image, :token)");
        $stmt->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'rol_id' => $user->getRolId(),
            'image' => $user->getImage(),
            'token' => $user->getToken()
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
            $user->setToken($data['token']);
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
            $user->setToken($data['token']);
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
            $user->setToken($row['token']);
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
            $user->setToken($row['token']);
            $users[] = $user;
        }

        return $users;
    }

    public function actualizar(User $user) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name, rol_id = :rol_id, image = :image, token = :token WHERE id = :id");
        $stmt->execute([
            'name' => $user->getName(),
            'rol_id' => $user->getRolId(),
            'image' => $user->getImage(),
            'id' => $user->getId(),
            'token' => $user->getToken()
        ]);
    }

    public function actualizarPasswordToken(User $user) {
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password, token = :token WHERE id = :id");
        $stmt->execute([
            'password' => $user->getPassword(),
            'id' => $user->getId(),
            'token' => $user->getToken()
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

    public function alternarFavorito($userId, $postId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM post_favoritos WHERE user_id = ? AND post_id = ?");
        $stmt->execute([$userId, $postId]);
        $existe = $stmt->fetchColumn() > 0;

        if ($existe) {
            $stmt = $this->pdo->prepare("DELETE FROM post_favoritos WHERE user_id = ? AND post_id = ?");
            $stmt->execute([$userId, $postId]);
            return 'eliminado';
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO post_favoritos (user_id, post_id) VALUES (?, ?)");
            $stmt->execute([$userId, $postId]);
            return 'añadido';
        }
    }

    public function yaEsFavorito($userId, $postId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM post_favoritos WHERE user_id = ? AND post_id = ?");
        $stmt->execute([$userId, $postId]);
        return $stmt->fetchColumn() > 0;
    }


    public function checkCorreoVerificacion($token) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE token = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        if ($user) {
            $sql = "UPDATE users SET rol_id = 3, token = NULL WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user['id']]);
            return true;
        }
        return false;
    }

    public function obtenerPorToken($token) {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->execute([$token]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $user = new User();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setRolId($data['rol_id']);
        $user->setImage($data['image']);
        $user->setToken($data['token']);
        return $user;
    }

    return null;
}



}
