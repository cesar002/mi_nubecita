<?php

namespace Models;

class UserModel{
    private $idUser;
    private $email;
    private $cloudStorageName;
    private $cloudStorageID;
    private $limiteAlmacenaje;

    public function construir(int $idUser, string $email, string $cloudStorageName, int $cloudStorageID, int $limiteAlmacenaje){
        $this->idUser = $idUser;
        $this->email = $email;
        $this->cloudStorageName = $cloudStorageName;
        $this->cloudStorageID = $cloudStorageID;
        $this->limiteAlmacenaje = $limiteAlmacenaje;
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

    public function setLimiteAlmacenaje(int $limiteAlmacenaje) : void{
        $this->limiteAlmacenaje = $limiteAlmacenaje;
    }

    public function getLimiteAlmacenaje() : int {
        return $this->limiteAlmacenaje;
    }


}