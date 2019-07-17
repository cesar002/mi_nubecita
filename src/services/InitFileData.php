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
    public static function getIniFileData() : array{
        try{
            $root = $_SERVER['DOCUMENT_ROOT'];
            self::$datosInit = parse_ini_file($root.'/mi_nubecita/config/config.ini');
            $data = self::$datosInit;
            return $data;
        }catch(\Error $err){
            return null;
        }
    }

    /**
     * Retorna la informacion del archivo init
     *
     * @return array
     */
    public static function getInitData() : array {
        if(empty(self::$datosInit)){
            self::getIniFileData();
        }

        return self::$datosInit;
    }

}

