<?php

class User {

    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $rol_id;
 

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getRolId(): string {
        return $this->rol_id;
    }

    public function setRolId(string $rol_id): void {
        $this->rol_id = $rol_id;
    }
}
