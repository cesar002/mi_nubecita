<?php
/**
 * DataBaseConector Class
 * 
 * Clase que permite la conexión y desconexión con la base de datos
 * 
 */

 namespace DataBase;

class DataBaseConector{
    /**
     * variable de tipo PDO que almacena una instancia de conexión con la base de datos
     *
     * @var PDO
     */
    private $conector = null;
    /**
     * Arreglo que almacena la información del archivo config.ini
     *
     * @var array
     */
    private $dbData = null;

    public function __construct(){
        $this->readInitFile();
    }

    /**
     * Realiza la conexión con la base de datos
     *
     * @return void
     */
    public function conectar() : void{
        try{
            if($dbData = null){
                throw new \Exception("Error al leer los datos del archivo de configuración");
            }

            $this->conector = new \PDO("mysql:dbname=".$dbData["db_name"]."; host=".$dbData["host"], $dbData["db_user"], $dbData["db_pass"]);
            $this->conector->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $pdoex){
            //aqui deben ir logs
        }catch(\Exception $e){
            //aqui deben ir logs
        }
    }

    /**
     * Retorna la instancia de conexión PDO
     *
     * @return \PDO|null
     */
    public function getDataBaseConector() : ?\PDO{
        return $this->conector();
    }

    /**
     * Ejecuta InitFileData::getIniFileData() para leer los datos del archivo config.ini
     *
     * @return void
     */
    private function readInitFile() : void{
        $this->dbData = Services\InitFileData::getIniFileData();
    }
    

}
