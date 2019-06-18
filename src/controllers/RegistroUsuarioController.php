<?php

namespace Controllers;

use DataBase\DBController;

class RegistroUsuarioController{
    /**
     * Instancia de DBController que permite interactuar con la base de datos
     *
     * @var DBController
     */
    private $dbConector = null;

    public function __construct(){
        $this->dbConector = new DBController();    
    }

    /**
     * Registra un usuario en la base de datos y retorna un arreglo con la siguiente estructura:
     * ["status", "mensaje", "error"]
     * 
     * el status indica el tipo de estado: 1-registro correcto, 2-correo ya existente, 3-error al insertar
     *
     * @param String $correo
     * @param String $pass
     * @return array
     */
    public function registrarUsuario(String $correo, String $pass) : array{
        if($this->existeCorreo($correo)){
            return [
                "status" => 2,
                "mensaje" => "ese correo ya existe"
            ];
        }

        try{
            $this->dbConector->connect();

            $this->dbConector->startTransaction();

            $passwordHash = password_hash($pass, PASSWORD_BCRYPT);
            $idInserted = $this->dbConector->insertAndGetID("INSERT INTO usuarios(correo, password) VALUES('$correo', '$passwordHash')");

            $this->dbConector->execSQLQuery("INSERT INTO limites_usuarios_almacenaje(id_usuario, id_limite) VALUES ($idInserted, 1)");

            $this->dbConector->commitTransaction();
            return [
                "status" => 1,
                "mensaje" => "registro éxitoso"
            ];
        }catch(\Exception $e){
            $this->dbConector->rollBackTransaction();
            return [
                "status" => 3,
                "mensaje" => "ocurrio un error en el servidor, intente más tarde",
                "error" => $e->getMessage()
            ];
        }catch(\PDOException $PDOe){
            $this->dbConector->rollBackTransaction();
            return [
                "status" => 3,
                "mensaje" => "ocurrio un error en el servidor, intente más tarde",
                "error" => $e->getMessage()
            ];
        }catch(\Error $err){
            $this->dbConector->rollBackTransaction();
            return [
                "status" => 3,
                "mensaje" => "ocurrio un error en el servidor, intente más tarde",
                "error" => $e->getMessage()
            ];
        }

    }

    /**
     * Retorna verdadero si el correo de entrada existe ya en la base de datos
     *
     * @param string $correo
     * @return boolean
     */
    private function existeCorreo(string $correo) : bool{
        try{
            $this->dbConector->connect();
            $resultados = $this->dbConector->getDataFromSelectQuery("SELECT id_usuario FROM usuarios WHERE correo = '$correo'");

            if(empty($resultados)){
                return false;
            }

            return true;
        }catch(\Exception $e){
            return false;
        }
    }

}
