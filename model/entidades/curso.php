<?php

class Curso {
    private $id;
    private $nombre;
    private $horas;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getHoras() {
        return $this->horas;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setHoras($horas): void {
        $this->horas = $horas;
    }


}
