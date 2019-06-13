<?php
/** 
* InitFileData Class
*
* Clase estatica que sirve como envoltorio para obtener los datos del archivo config.ini y retornarlos
*
*/

namespace Services;

class InitFileData{
    /**
     * $datosInit
     *
     * @var array
     */
    private static $datosInit;

    /**
     * Retorna un arreglo con los datos del archivo config.ini
     *
     * @return array|null
     */
    public static function getIniFileData() : ?array{
        try{
            $root = $_SERVER['DOCUMENT_ROOT'];
            return self::$datosInit = parse_ini_file($root.'/mi_nubecita/config/config.ini');
        }catch(\Error $err){
            return null;
        }
    }

}

