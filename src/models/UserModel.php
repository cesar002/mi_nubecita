<?php

namespace Models;

class UserModel{
    private $idUser;
    private $email;
    private $cloudStorageName;
    private $cloudStorageID;

    public function __construct(int $idUser, string $email, string $cloudStorageName, int $cloudStorageID){
        $this->idUser = $idUser;
        $this->email = $email;
        $this->cloudStorageName = $cloudStorageName;
        $this->cloudStorageID = $cloudStorageID;
    }

    public function setIdUser(int $idUser) : void{
        $this->idUser = $idUser;
    }

    public function getIdUser() : int{
        return $this->idUser;
    }

    public function setEmail(string $email) : void{
        $this->email = $email;
    }

    public function getEmail() : string{
        return $this->email;
    }

    public function setCloudStorageName(string $cloudStorageName) : void{
        $this->cloudStorageName = $cloudStorageName;
    }

    public function getCloudStorageName() : string{
        return $this->cloudStorageName;
    }

    public function setCloudStorageID(int $cloidStorageId) : void{
        $this->cloudStorageID = $cloidStorageId;
    }

    public function getCloudStorageID() : int{
        return $this->cloudStorageID;
    }


}