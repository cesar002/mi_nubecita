<?php

namespace HandleModel;

use Models\UserModel;
use Models\ArchivoEliminadoModel;
use Database\DBController;
use Services\EncryptService;

/**
 * Clase estatica ayudante que retorna objetos de tipo ArchivoEliminadoModel ya construidos, en individual o en array
 */
class ArchivoEliminadoModelHandle{

    /**
     * Retorna un array con los archivos eliminados en la papelera con formato ArchivoEliminadoModel, si no hay datos, retornará null
     *
     * @param UserModel $user
     * modelo de usuario
     * @return array|null
     */
    public static function getListaArchivosEliminados(UserModel $user) : ?array{
        $idPapelera = EncryptService::decrypt($user->getIdPapelera());

        $sql = "SELECT ae.* FROM archivos_eliminados AS ae
                    INNER JOIN papelera AS p ON p.id_papelera = ae.id_papelera
                WHERE p.id_papelera = $idPapelera ORDER BY ae.fecha_borrado_def, ae.fecha_borrado_temp";
        $db = new DBController();
        $db->connect();
        $result = $db->getDataFromSelectQuery($sql);

        if(is_null($result)){
            return null;
        }

        $archivosEliminados = [];
        foreach($result as $row){
            $archivoEliminadoM = new ArchivoEliminadoModel();
            $archivoEliminadoM->construir(EncryptService::encrypt($row["id_archivo_eliminado"]), EncryptService::encrypt($row["id_papelera"]), EncryptService::encrypt($row["id_archivo"]), $row["fecha_borrado_temp"], $row["borrado_temp"], $row["fecha_borrado_def"], $row["borrado_def"], $row["activo"]);
            array_push($archivosEliminados, $archivoEliminadoM);
        }

        return $archivosEliminados;
    }

}