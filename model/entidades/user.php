<?php

class User {

    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private int $rol_id;
    private string $image;

    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getRolId() {
        return $this->rol_id;
    }

    public function setRolId(int $rol_id) {
        $this->rol_id = $rol_id;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage(string $image) {
        $this->image = $image;
    }
    
}
