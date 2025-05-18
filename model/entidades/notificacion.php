<?php
    
class Notificacion {

    private int $id;
    private int $user_id;
    private int $post_id;
    private bool $is_read;
    private string $message;

    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId(int $user_id) {
        $this->user_id = $user_id;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function setPostId(int $post_id) {
        $this->post_id = $post_id;
    }
    
    public function getIsRead() {
        return $this->is_read ? 1 : 0;
    }

    public function setIsRead(bool $is_read) {
        $this->is_read = $is_read;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage(string $message) {
        $this->message = $message;
    }
}