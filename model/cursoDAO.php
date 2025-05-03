<?php
//require_once '../bd/database.php'; Ya está incluido en el index.php.
require_once 'entidades/curso.php';

class CursoDAO {

    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar() {
        try {       
            $stm = $this->pdo->prepare("SELECT * FROM cursos");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_CLASS, 'Curso');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM cursos WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetchObject("Curso");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar($id) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM cursos WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Curso $curso) {
        try {
            $stm = "UPDATE cursos SET nombre = ?, horas=? WHERE id = ?";
            $this->pdo->prepare($stm)->execute(array($curso->getNombre(), $curso->getHoras(), $curso->getId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function registrar(Curso $curso) {
        try {
            $sql = "INSERT INTO cursos (nombre, horas) VALUES (?, ?)";
            $this->pdo->prepare($sql)->execute(array($curso->getNombre(), $curso->getHoras()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
