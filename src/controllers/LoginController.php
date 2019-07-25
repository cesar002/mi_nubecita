<?php
namespace Controllers;

use DataBase\DBController;
use Models\UserModel;
use Services\JWTAuth;

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

            $user = $this->getUserModel($email);
            $token = JWTAuth::generateAuthToken($user);
            
            return[
                "status" => 1,
                "mensaje" => "correcto",
                "autorizacion_token" => $token,
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

    
    private function getUserModel(string $email) : UserModel{
        $this->dbConector = new DBController();

        $user = new UserModel();

        return $user;
    }

}