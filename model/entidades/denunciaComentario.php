<?php

class DenunciaComentario {
    private $id;
    private $comentarioId;
    private $usuarioId;
    private $motivo;
    private $fecha;

    public function getId () {
        return $this->id;
    }
    public function setId ($id) {
        $this->id = $id;
    }
    public function getComentarioId () {
        return $this->comentarioId;
    }
    public function setComentarioId ($comentarioId) {
        $this->comentarioId = $comentarioId;
    }
    public function getUsuarioId () {
        return $this->usuarioId;
    }
    public function setUsuarioId ($usuarioId) {
        $this->usuarioId = $usuarioId;
    }
    public function getMotivo () {
        return $this->motivo;
    }
    public function setMotivo ($motivo) {
        $this->motivo = $motivo;
    }
    public function getFecha () {
        return $this->fecha;
    }
    public function setFecha ($fecha) {
        $this->fecha = $fecha;
    }
}