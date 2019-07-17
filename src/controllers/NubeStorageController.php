<?php
namespace Controllers;

use Services\LogService;
use Services\InitFileData;
use DataBase\DBController;
use Models\UserModel;

class NubeStorageController{

    private $dbConnector;
    private $pathStorage;

    public function __construct(){
        $this->init();
    }

    /**
     * Crea y registra la carpeta principal de almacenaje de un usuario
     *
     * @param UserModel $user
     * @return boolean
     */
    public function createCloudeStorageUser(UserModel $user) : bool{
        try{
            $hashNameFolder = hash("ripemd160", $user->getEmail());
            $idUser = $user->getIdUser();

            mkdir($this->pathStorage.$hashNameFolder, 0777);

            $this->dbConnector = new DBController();
            $this->dbConnector->connect();

            $this->dbConnector->execSQLQuery("INSERT INTO nubes_usuarios(hash_name, id_usuario) VALUES ('$hashNameFolder', $idUser)");

            return true;
        }catch(\Error $err){
            return false;
        }catch(\Exception $e){
            return false;
        }catch(\PDOException $pdoEx){
            return false;
        }
    }

    public function createNewFolder(UserModel $user, string $folderName, string $pathStorage = "root") : array{
        
        $this->dbConnector = new DBController();

        try{
            if($pathStorage == "root"){


                return [];
            }
        }catch(\Exception $e){

        }catch(\Error $err){

        }catch(\PDOException $pdoEx){

        }
        
    }

    private function init() : void{
        $this->pathStorage = InitFileData::getInitData()["cloudStorage"];
    }


    // public function createFolder(string $folderName) : bool{
    //     try {
    //         $serverPath = InitFileData::getInitData();
    //         $foldePath = $serverPath["cloudStorage"].$$folderName;
    //         mkdir($foldePath);
    //     } catch (\Exception $e) {
    //         LogService::escribirLog("NubeStorageController.createFolder() - ".$e->getMessage());
    //         return false;
    //     }catch(\Error $err){
    //         LogService::escribirLog("NubeStorageController.createFolder() - ".$e->getMessage());
    //         return false;
    //     }
    // }

    // public function folderExist(string $folderName) : bool{
        
    //     $serverPath = InitFileData::getInitData();
    //     return file_exists($serverPath["cloudStorage"].$folderName);
    // }



}