<?php

namespace HandleModel;

use Models\UserModel;
use Models\CarpetaEliminadaModel;
use Database\DBController;
use Services\EncryptService;

/**
 * Clase estatica ayudante que retorna objetos de tipo CarpetasEliminadasModel ya construidos, en individual o en array
 */
class CarpetasEliminadasModelHandle{

    /**
     * Retorna un array con las carpetas eliminadas en la papelera en formato de CarpetaEliminadaModel, si no hay datos, retornará null
     *
     * @param UserModel $user
     * modelo de usuario
     * @return array|null
     */
    public static function getListaCarpetasEliminadas(UserModel $user) : ?array{
        $idPapelera = EncryptService::decrypt($user->getIdPapelera());

        $sql = "SELECT ca.* FROM carpetas_aliminadas AS ca
                    INNER JOIN papelera AS p ON p.id_papelera = ca.id_papelera AND ca.activo = 1
                WHERE p.id_papelera = $idPapelera ORDER BY ca.fecha_borrado_def, ca.fecha_borrado_temp";

        $db = new DBController();
        $db->connect();
        $result = $db->getDataFromSelectQuery($sql);

        if(is_null($result)){
            return null;
        }

        $carpetasEliminadas = [];
        foreach($result as $row){
            $carpetaEliminadaM = new CarpetaEliminadaModel();
            $carpetaEliminadaM->construir(EncryptService::encrypt($row["id_carpeta_eliminada"]), EncryptService::encrypt($row["id_papelera"]), EncryptService::encrypt($row["id_carpeta"]), $row["fecha_borrado_temp"], $row["borrado_temp"], $row["fecha_borrado_def"], $row["borrado_def"], $row["activo"]);
            array_push($carpetasEliminadas, $carpetaEliminadaM);
        }
        
        return $carpetasEliminadas;
    }

}