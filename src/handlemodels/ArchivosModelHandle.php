<?php

namespace HandleModel;

use Models\UserModel;
use Models\ArchivoModel;
use Database\DBController;
use Services\EncryptService;

/**
 * Clase estatica ayudante que retorna objetos de tipo ArchivoModel ya construidos, en individual o en array
 */
class ArchivosModelHandle{

    /**
     * Retorna un array de los archivos encontrados en root en formato ArchivoModel, si no hay datos retornará null
     *
     * @param UserModel $user
     * modelo de usuario
     * @return array|null
     */
    public static function getListArchivosInRoot(UserModel $user) : ?array {
        $idUsuario = EncryptService::decrypt($user->getIdUser());

        $sql = "SELECT ars.* FROM archivos_subidos AS ars
                    INNER JOIN carpetas_usuarios AS cu ON cu.id_carpeta = ars.id_carpeta
                    INNER JOIN nubes_usuarios AS nu ON nu.id_nube = cu.id_nube
                WHERE nu.id_usuario = $idUsuario AND cu.path_carpeta = 'root' ORDER BY fecha_subida";
        $db = new DBController();
        $db->connect();
        $result = $db->getDataFromSelectQuery($sql);

        if(is_null($sql)){
            return null;
        }

        $archivos = [];
        foreach($result as $row){
            $archivoM = new ArchivoModel();
            $archivoM->construir(EncryptService::encrypt($row["id_archivo"]), EncryptService::encrypt($row["id_carpeta"]), $row["nombre_archivo"], $row["tipo_archivo"], $row["size_file"], $row["fecha_subida"], $row["activo"]);
            array_push($archivos, $archivoM);
        }

        return $archivos;
    }

    /**
     * Retorna un array de los archivos en formato ArchivoModel según el path determinado, si no hay datos, retornará null
     *
     * @param UserModel $user
     * modelo de usuario
     * @param string $path
     * path a buscar
     * @return array|null
     */
    public static function getListArchivosByPath(UserModel $user, string $path) : ?array{
        $idUsuario = EncryptService::decrypt($user->getIdUser());
        $pathFolder = EncryptService::decrypt($path);

        $sql = "SELECT ars.* FROM archivos_subidos AS ars
                    INNER JOIN carpetas_usuarios AS cu ON cu.id_carpeta = ars.id_carpeta
                    INNER JOIN nubes_usuarios AS nu ON nu.id_nube = cu.id_nube
                WHERE nu.id_usuario = $idUsuario AND cu.path_carpeta = '$pathFolder' ORDER BY fecha_subida";
        $db = new DBController();
        $db->connect();
        $result = $db->getDataFromSelectQuery($sql);

        if(is_null($result)){
            return null;
        }

        $archivos = [];
        foreach($result as $row){
            $archivoM = new ArchivoModel();
            $archivoM->construir(EncryptService::encrypt($row["id_archivo"]), EncryptService::encrypt($row["id_carpeta"]), $row["nombre_archivo"], $row["tipo_archivo"], $row["size_file"], $row["fecha_subida"], $row["activo"]);
            array_push($archivos, $archivoM);
        }

        return $archivos;
    }


}