<?php
require_once 'entidades/denuncia.php';

class DenunciaDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM denuncias WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $denuncia = new Denuncia();
            $denuncia->setId($data['id']);
            $denuncia->setContenidoId($data['contenido_id']);
            $denuncia->setUsuarioId($data['usuario_id']);
            $denuncia->setTipo($data['tipo']);
            $denuncia->setMotivo($data['motivo']);
            $denuncia->setFecha($data['fecha']);
            return $denuncia;
        }

        return null;
    }

    public function obtenerPorUsuario(int $usuarioId) {
        $stmt = $this->pdo->prepare("SELECT * FROM denuncias WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $denuncias = [];
        foreach ($data as $row) {
            $denuncia = new Denuncia();
            $denuncia->setId($row['id']);
            $denuncia->setContenidoId($row['contenido_id']);
            $denuncia->setUsuarioId($row['usuario_id']);
            $denuncia->setTipo($row['tipo']);
            $denuncia->setMotivo($row['motivo']);
            $denuncia->setFecha($row['fecha']);
            $denuncias[] = $denuncia;
        }

        return $denuncias;
    }

    public function obtenerTodas() {
        $stmt = $this->pdo->prepare("SELECT * FROM denuncias");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $denuncias = [];
        foreach ($data as $row) {
            $denuncia = new Denuncia();
            $denuncia->setId($row['id']);
            $denuncia->setContenidoId($row['contenido_id']);
            $denuncia->setUsuarioId($row['usuario_id']);
            $denuncia->setTipo($row['tipo']);
            $denuncia->setMotivo($row['motivo']);
            $denuncia->setFecha($row['fecha']);
            $denuncias[] = $denuncia;
        }

        return $denuncias;
    }

    public function guardar(Denuncia $denuncia) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO denuncias (contenido_id, usuario_id, tipo, motivo, fecha)
             VALUES (:contenido_id, :usuario_id, :tipo, :motivo, :fecha)"
        );

        $stmt->execute([
            'contenido_id' => $denuncia->getContenidoId(),
            'usuario_id'   => $denuncia->getUsuarioId(),
            'tipo'         => $denuncia->getTipo(),
            'motivo'       => $denuncia->getMotivo(),
            'fecha'        => $denuncia->getFecha()
        ]);
    }

    public function eliminar(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM denuncias WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function eliminarDenunciasConContenidoId(int $contenidoId) {
        $stmt = $this->pdo->prepare("DELETE FROM denuncias WHERE contenido_id = ?");
        $stmt->execute([$contenidoId]);
    }
}
