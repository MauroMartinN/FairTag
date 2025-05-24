<?php

class Comment {
    private int $id;
    private string $content;
    private string $created_at;
    private int $user_id;
    private int $post_id;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function setPostId($post_id) {
        $this->post_id = $post_id;
    }

    // public function getUserName() {
    //     return $this->user_name;
    // }

    // public function setUserName($user_name) {
    //     $this->user_name = $user_name;
    // }

    //public function getUserImage() {
    //    return $this->user_image;
    //}

    //public function setUserImage($user_image) {
    //    $this->user_image = $user_image;
    //}
}
