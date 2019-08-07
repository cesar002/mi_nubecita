<?php

namespace HandleModel;

use Models\UserModel;
use Models\CarpetaModel;
use Database\DBController;
use Services\EncryptService;

/**
 * Clase estatica ayudante que retorna objetos de tipo CarpetaModelHandle ya construidos, en individual o en array
 */
class CarpetaModelHandle{

    /**
     * Retorna un array con modelos tipo CarpetaModel que se encuentren en la raíz de la nube, si no hay datos retornará Null
     *
     * @param UserModel $user
     * modelo de usuario
     * @return array|null
     */
    public static function getListCarpetaModelInRoot(UserModel $user) : ?array{
        $idUsuario = EncryptService::decrypt($user->getIdUser());
        $sql = "SELECT cu.* FROM carpetas_usuarios AS cu
                    INNER JOIN nubes_usuarios AS nu ON nu.id_nube = cu.id_nube
                WHERE nu.id_usuario = $idUsuario AND path_carpeta='root' ORDER BY cu.fecha_creacion";

        $db = new DBController();
        $db->connect();
        $result = $db->getDataFromSelectQuery($sql);
        
        if(is_null($result)){
            return null;
        }

        $carpetas = [];
        foreach($result as $row){
            $carpetaM = new CarpetaModel();
            $carpetaM->construir(EncryptService::encrypt($row["id_carpeta"]), EncryptService::encrypt($row["id_nube"]), $row["nombre_carpeta"], EncryptService::encrypt($row["path_carpeta"]), $row["fecha_creacion"], $row["activo"]);
            array_push($carpetas, $carpetaM);
        }
        
        return $carpetas;
    }

    /**
     * Retorna un array de tipo CarpetaModel que se encuentre en el path indicado, si no hay datos, retornará null
     *
     * @param UserModel $user
     * modelo de usuario
     * @param string $path
     * path donde busca las carpetas
     * @return array|null
     */
    public static function getListCarpetaModelByPath(UserModel $user, string $path) : ?array{
        $idUsuario = EncryptService::decrypt($user->getIdUser());
        $pathFolder = EncryptService::decrypt($path);
        $sql = "SELECT cu.* FROM carpetas_usuarios AS cu
                    INNER JOIN nubes_usuarios AS nu ON nu.id_nube = cu.id_nube
                WHERE nu.id_usuario = $idUsuario AND path_carpeta='$pathFolder' ORDER BY cu.fecha_creacion";

        $db = new DBController();
        $db->connect();
        $result = $db->getDataFromSelectQuery($sql);

        if(is_null($result)){
            return null;
        }

        $carpetas = [];
        foreach($result as $row){
            $carpetaM = new CarpetaModel();
            $carpetaM->construir(EncryptService::encrypt($row["id_carpeta"]), EncryptService::encrypt($row["id_nube"]), $row["nombre_carpeta"], EncryptService::encrypt($row["path_carpeta"]), $row["fecha_creacion"], $row["activo"]);
            array_push($carpetas, $carpetaM);
        }
        
        return $carpetas;
    }



}