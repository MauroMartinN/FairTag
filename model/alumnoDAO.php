<?php

/*
 * obtener($id): retorna un objeto de tipo Alumno
 * public function listar(): devuelve un array que contiene todas las filas del conjunto de resultados como objetos Alumno
 *  
 */

require_once 'entidades/alumno.php';
class AlumnoDAO
{
    private $pdo;
    
    public function __construct()
	{
		try
		{
			$this->pdo = Database::connect();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function listar()
	{
		try
		{			

			$stm = $this->pdo->prepare("SELECT * FROM alumnos");
			$stm->execute();
                        
			return $stm->fetchAll(PDO::FETCH_CLASS, 'Alumno');
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function obtener($id)
	{ 
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM alumnos WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchObject("Alumno");
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM alumnos WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function actualizar(Alumno $alumno)
	{
		try 
		{
			$sql = "UPDATE alumnos SET 
						nombre          = ?, 
						apellido        = ?,
                                                correo        = ?,
						sexo            = ?, 
						fechaNacimiento = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $alumno->getNombre(), 
                        $alumno->getCorreo(),
                        $alumno->getApellido(),
                        $alumno->getSexo(),
                        $alumno->getFechaNacimiento(),
                        $alumno->getId()
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function registrar(Alumno $alumno)
	{
		try 
		{
		$sql = "INSERT INTO alumnos (nombre,correo,apellido,sexo,fechaNacimiento,fechaRegistro) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $alumno->getNombre(),
                    $alumno->getCorreo(), 
                    $alumno->getApellido(), 
                    $alumno->getSexo(),
                    $alumno->getFechaNacimiento(),
                    date('Y-m-d')
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
        
        //Otras funciones
        public function buscarPor($nombreCampo, $valorCampo){
            try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM alumnos WHERE $nombreCampo='$valorCampo'");
			$stm->execute();
                        
			return $stm->fetchAll(PDO::FETCH_CLASS, 'Alumno');
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
        }
        
        public function alumnosCurso($idCurso){
            
        }
        
        public function relacion($nombreTabla, $idFK){
            
            
        }
        
        //Los métodos comunes a varias clases pueden implementarse en una clase GeneralDAO
}