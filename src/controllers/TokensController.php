<?php

namespace Controllers;

use DataBase\DBController;
use Services\DateService;
use Models\UserModel;
use Services\EncryptService;

/**
 * Clase que controla el comportamiento de los tokens de contraseña y verificación de cuenta
 */
class TokensController{
    private $dbController;

    /**
     * Registra un token de verificación de cuenta
     *
     * @param string $token
     * token de verificacion
     * @param UserModel $user
     * modelo de usuario
     * @return boolean
     */
    public function registrarTokenVerificadorCuenta(string $token, UserModel $user) : bool {
        try{
            $this->dbController = new DBController();
            
            $this->dbController->connect();

            $this->dbController->startTransaction();

            $idUser = EncryptService::decrypt($user->getIdUser());

            $idToken = $this->dbController->insertAndGetID("INSERT INTO tokens_verificacion_cuenta(token) VALUES ('$token')");
            $fechaLimite = DateService::addDaysToCurrentDate(10);
            $this->dbController->execSQLQuery("INSERT INTO tokens_verificacion_cuenta_asociados_usuarios VALUES ($idToken, $idUser, '$fechaLimite', NULL)");
            
            $this->dbController->commitTransaction();

            return true;
        }catch(\Exception $e){
            $this->dbController->rollBackTransaction();
            return false;
        }catch(\Error $err){
            $this->dbController->rollBackTransaction();
            return false;
        }catch(\PDOException $PDOex){
            $this->dbController->rollBackTransaction();
            return false;
        }
    }

    /**
     * Verifica y utiliza el token ingresado
     *
     * @param string $token
     * @return boolean
     */
    public function verificarTokenVerificadorCuenta(string $token) : bool{
        if(!$this->checkTokenVerificadorCuenta($token)){
            return false;
        }

        if(!$this->usarTokenVerificadorCuenta($token)){
            return false;
        }

        return true;
    }

    /**
     * Retorna verdadero si el token de verificación de cuenta se encuentra valido
     *
     * @param string $token
     * token de verificacion
     * @return boolean
     */
    private function checkTokenVerificadorCuenta(string $token) : bool{
        try{
            $this->dbController = new DBController();
            $this->dbController->connect();

            $sql = "SELECT * FROM tokens_verificacion_cuenta AS tvc
                        INNER JOIN tokens_verificacion_cuenta_asociados_usuarios AS tvca ON tvca.id_token = tvc.id_token
                    WHERE tvc.token = '$token' AND tvc.activo = 1";
            $res = $this->dbController->getDataFromSelectQuery($sql);

            if(is_null($res)){
                return false;
            }

            if(!DateService::comparerWithCurrentDate($res["fecha_limite"])){
                return true;
            }


            return false;
        }catch(\Exception $e){
            return false;
        }catch(\Error $err){
            return false;
        }catch(\PDOException $PDOex){
            return false;
        }
    }



    /**
     * Marca como usado el token de verificación de cuenta
     *
     * @param string $token
     * token de verificación
     * @return bool
     */
    private function usarTokenVerificadorCuenta(string $token) : bool{
        try{
            $this->dbController = new DBController();
            $this->dbController->connect();

            $res = $this->dbController->getDataFromSelectQuery("SELECT tvc.id_token FROM tokens_verificacion_cuenta AS tvc
                                                                    INNER JOIN tokens_verificacion_cuenta_asociados_usuarios AS tvca ON tvca.id_token = tvc.id_token
                                                                WHERE tvc.token = '$token' AND tvc.activo = 1");
            if(is_null($res)){
                return false;
            }

            $idToken = $res["id_token"];
            $date = date("Y-m-d");

            $this->dbController->startTransaction();

            $this->dbController->execSQLQuery("UPDATE tokens_verificacion_cuenta SET activo = 0 WHERE id_token = $idToken");
            $this->dbController->execSQLQuery("UPDATE tokens_verificacion_cuenta_asociados_usuarios SET fecha_uso = '$date' WHERE id_token = $idToken");
    
            $this->dbController->commitTransaction();

            return true;
        }catch(\Exception $e){
            $this->dbController->rollBackTransaction();
            return false;
        }catch(\Error $err){
            $this->dbController->rollBackTransaction();
            return false;
        }catch(\PDOException $PDOex){
            $this->dbController->rollBackTransaction();
            return false;
        }
    }


}