<?php
namespace Controllers;

use DataBase\DBController;

/**
 * Clase que controla el login del usuario
 */
class LoginController{

    private $dbConector;

    /**
     * Retorna un estado que indica si los datos de logeo son correctos.
     *
     * @param string $email
     * email del usuario
     * @param string $password
     * contraseña del usuario
     * @return array
     * objeto con el estado del logeo, propiedad status: 1-correcto, 2-datos no encontrados, 0-error de consulta
     */
    public function Logearse(string $email, string $password) : array{
        $this->dbConector = new DBController();

        try{
            $datosUsuarios = $this->dbConector->getDataFromSelectQuery("SELECT correo, password, verificado, activo FROM usuarios WHERE correo = '$email'");
            if(is_null($datosUsuarios)){
                return [
                    "status" => 2,
                    "mensaje" => "Datos incorrectos"
                ];
            }

            if(!password_verify($password, $datosUsuarios["password"])){
                return [
                    "status" => 2,
                    "mensaje" => "Datos incorrectos"
                ];
            }

            $_SESSION["email_usuario"] = $datosUsuarios["correo"];
            
            return[
                "status" => 1,
                "mensaje" => "correcto"
            ];
        }catch(\Exception $e){
            return [
                    "status" => 0,
                    "mensaje" => "Error del servidor"
                ];
        }catch(\Error $err){
            return [
                    "status" => 0,
                    "mensaje" => "Error del servidor"
                ];
        }catch(\PDOException $pdoerr){
            return [
                    "status" => 0,
                    "mensaje" => "Error del servidor"
                ];
        }
    }

}