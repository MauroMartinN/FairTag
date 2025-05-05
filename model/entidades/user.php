<?php

class User {

    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $rol_id;
 

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

    public function setRolId(string $rol_id) {
        $this->rol_id = $rol_id;
    }
}
