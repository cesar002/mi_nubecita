<?php

namespace Controllers;

use DataBase\DBController;
use Services\DateService;

class TokensController{
    private $dbController;

    public function registrarTokenVerificadorCuenta(string $token, int $idUser, string $email) : bool {
        try{
            $this->dbController = new DBController();
            
            $this->dbController->connect();

            $this->dbController->startTransaction();

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


}