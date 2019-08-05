<?php
namespace Controllers;

use Services\LogService;
use Services\EncryptService;
use Services\InitFileData;
use DataBase\DBController;
use Models\UserModel;

/**
 * Clase que permite subir archivos al cloudStorage
 */
class UploadStorageController{

    private $dbConnector;
    private $pathStorage;

    public function __construct(){
        $this->init();
    }

    /**
     * Funcion inicializadora
     *
     * @return void
     */
    private function init() : void{
        $this->pathStorage = InitFileData::getInitData()["cloudStorage"];
    }

    /**
     * Crea y registra la carpeta principal de almacenaje de un usuario
     *
     * @param UserModel $user
     * modelo de usuario
     * @return boolean
     */
    public function createCloudeStorageUser(UserModel $user) : bool{
        try{
            $hashNameFolder = hash("ripemd160", $user->getEmail());
            $idUser = EncryptService::decrypt($user->getIdUser());

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

    /**
     * Crea una nueva carpeta en el cloudstorage del usuario
     *
     * @param UserModel $user
     * modelo del usuario
     * @param string $folderName
     * nombre del la nueva carpeta
     * @param string $pathStorage
     * path donde se va a crear la nueva carpeta, por defecto en la raiz de la nube
     * @return array
     */
    public function createNewFolder(UserModel $user, string $folderName, string $pathStorage = "root") : array{
        try{
            $this->dbConnector = new DBController();

            $idCloud = EncryptService::decrypt($user->getCloudStorageID());

            if($pathStorage == "root"){
                $pathFolder = $this->pathStorage.$user->getCloudStorageName()."\\$folderName";

                mkdir($pathFolder, 0777);

                $this->dbConnector->connect();
                $this->dbConnector->execSQLQuery("INSERT INTO carpetas_usuarios(id_nube, nombre_carpeta) VALUES ($idCloud, '$folderName')");

                return [
                    "status" => 1,
                    "mensaje" => "Creacion correcta"
                ];
            }else{
                $pathFolder = $this->pathStorage.$user->getCloudStorageName()."\\$pathStorage\\$folderName";

                mkdir($pathFolder, 0777);

                $this->dbConnector->connect();
                $this->dbConnector->execSQLQuery("INSERT INTO carpetas_usuarios(id_nube, nombre_carpeta, path_carpeta) VALUES ($idCloud, '$folderName', '$pathStorage')");

                return [
                    "status" => 1,
                    "mensaje" => "Creacion correcta"
                ];
            }
        }catch(\Exception $e){
            return [
                "status" => 0,
                "mensaje" => $e->getMessage(),
            ];
        }catch(\Error $err){
            return [
                "status" => 0,
                "mensaje" => $err->getMessage(),
            ];
        }catch(\PDOException $pdoEx){
            return [
                "status" => 0,
                "mensaje" => $pdoEx->getMessage(),
            ];
        }
    }

    /**
     * Guarda en el cloudStore del usuario un archivo subido y lo registra en la base de datos
     *
     * @param UserModel $user
     * modelo del usuario
     * @param string $pathUpload
     * path del cloudStore donde se va a guardar el archivo
     * @param object $fileTemp
     * archivo con nombre temporal
     * @param object $file
     * variable de tipo $_FILE que haga referencia solo al archivo
     * @return array
     */
    public function uploadFile(UserModel $user,string $pathUpload, object $fileTemp, object $file) : array{
        $this->dbConnector = new DBController();
        $sizeFile = (filesize($fileTemp) * 1)/1000000;

        if($sizeFile > $user->getLimiteAlmacenaje()){
            return[
                "status" => 2,
                "mensaje" => "el archivo supera el limite de almacenaje del usuario",
            ];
        }

        
        try{
            $this->dbConnector->startTransaction();

            $fileName = $file['name'];
            $uploadFile = $pathUpload.basename($file['name']);
            $typeFile = pathinfo($uploadFile)['extension'];
            $idCarpeta = $this->getIdCarpetaUsuario($user, $pathUpload);
            $insert = "INSERT INTO archivos_subidos(id_carpeta, nombre_archivo, tipo_archivo, size_file) VALUES ($idCarpeta, '$fileName', '$typeFile', $sizeFile)";
    
            $this->dbConnector->execSQLQuery($insert);
        }catch(\Error $err){
            $this->dbConnector->rollBackTransaction();
            return [
                "status" => 0,
                "mensaje" => "error al subir el archivo",
            ];
        }catch(\Exception $e){
            $this->dbConnector->rollBackTransaction();
            return [
                "status" => 0,
                "mensaje" => "error al subir el archivo",
            ];
        }catch(\PDOException $pdoerr){
            $this->dbConnector->rollBackTransaction();
            return [
                "status" => 0,
                "mensaje" => "error al subir el archivo",
            ];
        }

        if(move_uploaded_file($fileTemp, $uploadFile)){

            $this->dbConnector->commitTransaction();

            return [
                "status" => 1,
                "mensaje" => "se subió el archivo correctamente",
            ];    
        }

        $this->dbConnector->rollBackTransaction();
        return [
            "status" => 0,
            "mensaje" => "error al subir el archivo",
        ];
    }
    
    /**
     * Retorna el id de la carpeta dentro del cloudStore del usuario, si no existe, retornará -1
     *
     * @param UserModel $user
     * model del usuario
     * @param string $pathFolder
     * path de la carpeta dentro del cloudStore
     * @return integer
     */
    private function getIdCarpetaUsuario(UserModel $user, string $pathFolder) : int{
        $idUser = EncryptService::decrypt($user->getIdUser());
        $sqlQuery = "SELECT cu.id_carpeta FROM usuarios AS us
                        INNER JOIN nubes_usuarios AS nu ON nu.id_usuario = us.id_usuario
                        INNER JOIN carpetas_usuarios AS cu ON cu.id_nube = nu.id_nube
                    WHERE us.id_usuario = $idUser AND cu.path_carpeta = '$pathFolder'";

        $this->dbConnector = new DBController();
        $this->dbConnector->connect();
        $res = $this->dbConnector->getOneDataFromSelectQuery($sqlQuery);

        if (is_null($res)){
            return -1;
        }

        return $res["id_carpeta"];
    }


}