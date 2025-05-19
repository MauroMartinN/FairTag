<?php
require_once 'entidades/denunciaComentario.php';

class DenunciaComentarioDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function guardar(DenunciaComentario $denuncia) {
        $stmt = $this->pdo->prepare("
            INSERT INTO denuncia_comentario (comentario_id, usuario_id, motivo, fecha)
            VALUES (:comentario_id, :usuario_id, :motivo, :fecha)
        ");
        $stmt->execute([
            'comentario_id' => $denuncia->getComentarioId(),
            'usuario_id' => $denuncia->getUsuarioId(),
            'motivo' => $denuncia->getMotivo(),
            'fecha' => $denuncia->getFecha()
        ]);
    }

    public function obtenerTodas() {
        $stmt = $this->pdo->prepare("SELECT * FROM denuncia_comentario");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $denuncias = [];
        foreach ($data as $row) {
            $denuncia = new DenunciaComentario();
            $denuncia->setId($row['id']);
            $denuncia->setComentarioId($row['comentario_id']);
            $denuncia->setUsuarioId($row['usuario_id']);
            $denuncia->setMotivo($row['motivo']);
            $denuncia->setFecha($row['fecha']);
            $denuncias[] = $denuncia;
        }

        return $denuncias;
    }

    public function eliminar(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM denuncia_comentario WHERE id = ?");
        $stmt->execute([$id]);
    }
}
