<?php

class Alumno
{
       
    private $id;
    private $nombre;
    private $apellido;
    private $sexo;
    private $fechaRegistro;
    private $fechaNacimiento;
    private $foto;
    private $correo;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getFoto() {
        return $this->foto;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setApellido($apellido): void {
        $this->apellido = $apellido;
    }

    function setSexo($sexo): void {
        $this->sexo = $sexo;
    }

    function setFechaRegistro($fechaRegistro): void {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaNacimiento($fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setFoto($foto): void {
        $this->foto = $foto;
    }

    function setCorreo($correo): void {
        $this->correo = $correo;
    }


    
}