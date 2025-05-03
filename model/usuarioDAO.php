<?php
require_once 'entidades/usuario.php';

class UsuarioDAO {
    private $pdo;

    public function __construct() {
        try
		{
			$this->pdo = Database::connect();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
    
    public function obtenerPorUsuario(string $usuario): ?Usuario {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->execute(['usuario' => $usuario]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            $usuarioObj = new Usuario();
            $usuarioObj->setNombre($data['nombre']);
            $usuarioObj->setUsuario($data['usuario']);
            $usuarioObj->setEmail($data['email']);
            $usuarioObj->setPassword($data['password']);
            $usuarioObj->setPrivilegio($data['privilegio']);
            $usuarioObj->setFechaRegistro($data['fecha_registro']);
            return $usuarioObj;
        }
        return null;
    }

    public function registrar(Usuario $usuario){
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, usuario, email, password, privilegio) VALUES (:nombre, :usuario, :email, :password, :privilegio)");
        $stmt->execute([
            'nombre' => $usuario->getNombre(),
            'usuario' => $usuario->getUsuario(),
            'email' => $usuario->getEmail(),
            'password' => password_hash($usuario->getPassword(), PASSWORD_DEFAULT),
            'privilegio' => $usuario->getPrivilegio()
        ]);
    }
    
    public function obtener($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetchObject("Usuario");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

