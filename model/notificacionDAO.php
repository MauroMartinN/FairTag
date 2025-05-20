<?php
require_once 'entidades/notificacion.php';

class NotificacionDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM notification WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $notification = new Notificacion();
            $notification->setId($data['id']);
            $notification->setUserId($data['user_id']);
            $notification->setPostId($data['post_id']);
            $notification->setIsRead($data['is_read']);
            $notification->setMessage($data['message']);
            return $notification;
        }

        return null;
    }

    public function obtenerPorUsuario(int $userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM notification WHERE user_id = ?");
        $stmt->execute([$userId]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $notifications = [];
        foreach ($data as $row) {
            $notification = new Notificacion();
            $notification->setId($row['id']);
            $notification->setUserId($row['user_id']);
            $notification->setPostId($row['post_id']);
            $notification->setIsRead($row['is_read']);
            $notification->setMessage($row['message']);
            $notifications[] = $notification;
        }

        return $notifications;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM notification");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $notifications = [];
        foreach ($data as $row) {
            $notification = new Notificacion();
            $notification->setId($row['id']);
            $notification->setUserId($row['user_id']);
            $notification->setPostId($row['post_id']);
            $notification->setIsRead($row['is_read']);
            $notification->setMessage($row['message']);
            $notifications[] = $notification;
        }

        return $notifications;
    }

    public function guardar(Notificacion $notification) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notification (user_id, post_id, is_read, message)
             VALUES (:user_id, :post_id, :is_read, :message)"
        );

        $stmt->execute([
            'user_id' => $notification->getUserId(),
            'post_id' => $notification->getPostId(),
            'is_read' => $notification->getIsRead(),
            'message' => $notification->getMessage()
        ]);
    }

    public function eliminar(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM notification WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function marcarTodasComoLeidas(int $userId) {
        $stmt = $this->pdo->prepare("UPDATE notification SET is_read = 1 WHERE user_id = ?");
        $stmt->execute([$userId]);
    }

    public function eliminarLeidas(int $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM notification WHERE is_read = 1 AND user_id = ?");
        $stmt->execute([$userId]);
    }

    public function eliminarTodas(int $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM notification WHERE user_id = ?");
        $stmt->execute([$userId]);
    }
}
