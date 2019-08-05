<?php

namespace HandleModel;

use Models\UserModel;
use Database\DBController;
use Services\EncryptService;

/**
 * Clase estatica que permite generar una instancia de usermodel
 */
class UserModelHandle{

    /**
     * Retorna una instancia de UserModel mediante la contraseña y password, si no hay datos retornará null
     *
     * @param string $email
     * @param string $password
     * @return UserModel|null
     */
    public static function generateUserModel(string $email, string $password) : ?UserModel{
        $db = new DBController();
        $db->connect();

        $rest = $db->getDataFromSelectQuery("SELECT us.id_usuario, us.correo, us.password ,nu.hash_name, nu.id_nube, la.limite, la.tipo_limite FROM usuarios AS us
                                                INNER JOIN limites_usuarios_almacenaje AS lua ON lua.id_usuario = us.id_usuario
                                                INNER JOIN limites_almacenaje AS la ON la.id_limite = lua.id_limite
                                                INNER JOIN nubes_usuarios AS nu ON nu.id_usuario = us.id_usuario
                                            WHERE us.correo = '$email'");

        if(!password_verify($password, $rest["pasword"])){
            return null;
        }

        $usermodel = new UserModel();
        $usermodel->construir(EncryptService::encrypt($rest["id_usuario"]), $rest["correo"], $rest["hash_name"], EncryptService::encrypt($rest["id_nube"]), $rest["limite"], $rest["tipo_limite"]);

        return $usermodel;
    }

    /**
     * Retorna una instancia de Usermodel por el id del usuario, si no hay datos retornará null
     *
     * @param [type] $idUser
     * @return UserModel|null
     */
    public static function generateUserModelByID($idUser) : ?UserModel{
        $db = new DBController();
        $db->connect();

        $rest = $db->getDataFromSelectQuery("SELECT us.id_usuario, us.correo, nu.hash_name, nu.id_nube, la.limite, la.tipo_limite FROM usuarios AS us
                                                INNER JOIN limites_usuarios_almacenaje AS lua ON lua.id_usuario = us.id_usuario
                                                INNER JOIN limites_almacenaje AS la ON la.id_limite = lua.id_limite
                                                INNER JOIN nubes_usuarios AS nu ON nu.id_usuario = us.id_usuario
                                            WHERE us.id_usuario = $idUser");

        if(is_null($rest)){
            return null;
        }

        $usermodel = new UserModel();
        $usermodel->construir(EncryptService::encrypt($rest["id_usuario"]), $rest["correo"], $rest["hash_name"], EncryptService::encrypt($rest["id_nube"]), $rest["limite"], $rest["tipo_limite"]);

        return $usermodel;
    }

}