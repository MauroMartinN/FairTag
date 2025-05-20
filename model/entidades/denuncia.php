<?php

class Denuncia {
    private int $id;
    private int $contenidoId;
    private int $usuarioId;
    private string $tipo;
    private string $motivo;
    private string $fecha;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getContenidoId() {
        return $this->contenidoId;
    }
    public function setContenidoId($contenidoId) {
        $this->contenidoId = $contenidoId;
    }

    public function getUsuarioId() {
        return $this->usuarioId;
    }
    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }

    public function getTipo() {
        return $this->tipo;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getMotivo() {
        return $this->motivo;
    }
    public function setMotivo($motivo) {
        $this->motivo = $motivo;
    }

    public function getFecha() {
        return $this->fecha;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
