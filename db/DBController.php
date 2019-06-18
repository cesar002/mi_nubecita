<?php
namespace DataBase;

/**
 * DBController Class
 * 
 * Clase controladora de la base de datos que permite la interaccion con la base de datos,
 * inserciones, actualizaciones, etc.
 * 
 */

 use DataBase\DataBaseConector;

class DBController{
    /**
     * instancia de la clase DataBaseConecto que permite la conexión con la base de datos
     *
     * @var DataBaseConector
     */
    private $conector;

    public function __construct(){
        $this->conector = new DataBaseConector();
    }

    /**
     * Conecta con la base de datos, debe usarse antes de ejecutar los metodos de interaccion con la base de datos
     *
     * @return void
     */
    public function connect() : void{
        $this->conector->conectar();
    }

    /**
     * permite realizar una insercion y retorna el ID del elemento insertado, siempre y cuando la llave primaria sea AUTO_INCREMENT
     *
     * @param String $query
     * @return integer
     */
    public function insertAndGetID(String $query) : int{
        try{
            $this->conector->getDataBaseConector()->exec($query);
            try{
                return (int)$this->conector->getDataBaseConector()->lastInsertId();
            }catch(\Error $err){ return -1; }
            
        }catch(\PDOException $PDOe){ return -1;}
        catch(\Error $err){ return -1; }
        catch(\Exception $e){ return -1; }

    }

    /**
     * Permite ejecutar una sentencia SQL
     *
     * @param string $query
     * @return void
     */
    public function execSQLQuery(string $query) : void{
        try{
            $this->conector->getDataBaseConector()->exec($query);
        }catch(\PDOException $PDOex){
            throw new \Exception($PDOex->getMessage());
        }catch(\Error $err){
            throw new \Exception($err->getMessage());
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Ejecuta una sentencia SELECT y retorna los datos obtenidos, si no existen datos u ocurre un error, retornará NULL
     *
     * @param string $query
     * @return array|null
     */
    public function getDataFromSelectQuery(string $query) : ?array{
        try{
            $res = $this->conector->getDataBaseConector()->query($query);
            return $res->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\Exception $e){
            return null;
        }catch(\PDOException $PDOe){
            return null;
        }catch(\Error $err){
            return null;
        }
    }

    /**
     * Inicia la transaccion
     *
     * @return void
     */
    public function startTransaction() : void{
        $this->conector->getDataBaseConector()->beginTransaction();
    }

    /**
     * Realiza Commit para mantener los cambios realizados
     *
     * @return void
     */
    public function commitTransaction() : void{
        $this->conector->getDataBaseConector()->commit();
    }

    /**
     * Borra los acciones hechas en la transaccion
     *
     * @return void
     */
    public function rollBackTransaction() : void{
        $this->conector->getDataBaseConector()->rollback();
    }

    

}
