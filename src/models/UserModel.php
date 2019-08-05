<?php

namespace Models;

class UserModel{
    private $idUser;
    private $email;
    private $cloudStorageName;
    private $cloudStorageID;
    private $limiteAlmacenaje;
    private $tipoLimite;

    public function construir(string $idUser, string $email, string $cloudStorageName, string $cloudStorageID, int $limiteAlmacenaje, string $tipoLimite){
        $this->idUser = $idUser;
        $this->email = $email;
        $this->cloudStorageName = $cloudStorageName;
        $this->cloudStorageID = $cloudStorageID;
        $this->limiteAlmacenaje = $limiteAlmacenaje;
        $this->tipoLimite = $tipoLimite;
    }

    public function setIdUser(string $idUser) : void{
        $this->idUser = $idUser;
    }

    public function getIdUser() : string{
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

    public function setCloudStorageID(string $cloidStorageId) : void{
        $this->cloudStorageID = $cloidStorageId;
    }

    public function getCloudStorageID() : string{
        return $this->cloudStorageID;
    }

    public function setLimiteAlmacenaje(int $limiteAlmacenaje) : void{
        $this->limiteAlmacenaje = $limiteAlmacenaje;
    }

    public function getLimiteAlmacenaje() : int {
        return $this->limiteAlmacenaje;
    }

    public function setTipoLimite(string $tipoLimite) : void{
        $this->tipoLimite = $tipoLimite;
    }

    public function getTipoLimite() : string{
        return $this->tipoLimite;
    }

    public function toArray() : array{
        return [
            "idUserHash" => $this->idUser,
            "email" => $this->email,
            "cloudStoreName" => $this->cloudStorageNamel,
            "cloudeStoreIddHash" => $this->cloudStorageID,
            "limite almacenaje" => $this->limiteAlmacenaje,
            "tipoLimite" => $this->tipoLimite,
        ];
    }


}