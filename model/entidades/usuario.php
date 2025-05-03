<?php

class Usuario {

    private int $id;
    private string $nombre;
    private string $usuario;
    private string $email;
    private string $password;
    private int $privilegio;
    private string $fechaRegistro;
 

        //usuario - login
   /* public function __construct(?int $id, string $nombre, string $usuario, string $email, string $password, int $privilegio, string $fechaRegistro) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->password = $password;
        $this->privilegio = $privilegio;
        $this->fechaRegistro = $fechaRegistro;
    }*/

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getUsuario(): string {
        return $this->usuario;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getPrivilegio(): int {
        return $this->privilegio;
    }

    public function getFechaRegistro(): string {
        return $this->fechaRegistro;
    }
    
       public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setUsuario(string $usuario): void {
        $this->usuario = $usuario;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setPrivilegio(int $privilegio): void {
        $this->privilegio = $privilegio;
    }

    public function setFechaRegistro(string $fechaRegistro): void {
        $this->fechaRegistro = $fechaRegistro;
    }
}
