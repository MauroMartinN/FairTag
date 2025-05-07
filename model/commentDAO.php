<?php
require_once 'entidades/Comment.php';

class CommentDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $comment = new Comment();
            $comment->setId($data['id']);
            $comment->setContent($data['content']);
            $comment->setCreatedAt($data['created_at']);
            $comment->setUserId($data['user_id']);
            $comment->setPostId($data['post_id']);
            $comment->setUserName($data['user_name']);
            // $comment->setUserImage($data['user_image']);
            return $comment;
        }

        return null;
    }

    public function obtenerPorPostId(int $post_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE post_id = ?");
        $stmt->execute([$post_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $comments = [];
        foreach ($data as $row) {
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setContent($row['content']);
            $comment->setCreatedAt($row['created_at']);
            $comment->setUserId($row['user_id']);
            $comment->setPostId($row['post_id']);
            $comment->setUserName($row['user_name']);
            // $comment->setUserImage($row['user_image']);
            $comments[] = $comment;
        }

        return $comments;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM comments");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $comments = [];
        foreach ($data as $row) {
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setContent($row['content']);
            $comment->setCreatedAt($row['created_at']);
            $comment->setUserId($row['user_id']);
            $comment->setPostId($row['post_id']);
            $comments[] = $comment;
        }

        return $comments;
    }

    public function guardar(Comment $comment) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO comments (content, created_at, user_id, post_id, user_name) 
            VALUES (:content, :created_at, :user_id, :post_id, :user_name)"
        );
        $stmt->execute([
            'content' => $comment->getContent(),
            'created_at' => $comment->getCreatedAt(),
            'user_id' => $comment->getUserId(),
            'post_id' => $comment->getPostId(),
            'user_name' => $comment->getUserName()
            // 'user_image' => $comment->getUserImage()
        ]);
    }

    public function eliminar(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$id]);
    }
}
