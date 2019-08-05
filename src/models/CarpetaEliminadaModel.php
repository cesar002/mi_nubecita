<?php

namespace Models;

class CarpetaEliminadaModel{
    private $idCarpetaEliminada;
    private $idPapelera;
    private $idCarpeta;
    private $fechaBorradoTemp;
    private $borradoTemp;
    private $fechaBorradoDef;
    private $borradoDef;
    private $activo;

    public function construir(int $idCarpetaEliminada, int $idPapelera, int $idCarpeta, string $fechaBorradoTemp, bool $borradoTemp, string $fechaBorradoDef, bool $borradoDef, bool $activo){
        $this->idCarpetaEliminada = $idCarpetaEliminada;
        $this->idPapelera = $idPapelera;
        $this->idCarpeta = $idCarpeta;
        $this->fechaBorradoTemp =  $fechaBorradoTemp;
        $this->borradoTemp = $borradoTemp;
        $this->fechaBorradoDef = $fechaBorradoDef;
        $this->borradoDef = $borradoDef;
        $this->activo = $activo;
    }

    public function setidCarpetaEliminada(int $idCarpetaEliminada) : void{
        $this->idCarpetaEliminada = $idCarpetaEliminada;
    }

    public function getidCarpetaEliminada() : int{
        return $this->idCarpetaEliminada;
    }

    public function setIdPapelera(int $idPapelera) : void{
        $this->idPapelera = $idPapelera;
    }

    public function getIdPapelera() : int{
        return $this->idPapelera;
    }

    public function setidCarpeta(int $idCarpeta) : void{
        $this->idCarpeta = $idCarpeta;
    }

    public function getidCarpeta() : int{
        return $this->idCarpeta;
    }

    public function setFechaBorradoTemp(string $fechaBorradoTemp) : void{
        $this->fechaBorradoTemp = $fechaBorradoTemp;
    }

    public function getFechaBorradoTemp() : string{
        return $this->fechaBorradoTemp;
    }

    public function setBorradoTemp(bool $borradoTemp) : void{
        $this->borradoTemp = $borradoTemp;
    }

    public function getBorradoTemp() : bool{
        return $this->borradoTemp;
    }

    public function setFechaBorradoDef(string $fechaBorradoDef) : void{
        $this->fechaBorradoTemp = $fechaBorradoDef;
    }

    public function getFechaBorradoDef() : string{
        return $this->fechaBorradoDef;
    }

    public function setBorradoDef(bool $borradoDef) : void{
        $this->borradoTemp = $borradoDef;
    }

    public function getBorradoDef() : bool{
        return $this->borradoDef;
    }

    public function setActivo(bool $activo) : void{
        $this->activo = $activo;
    }

    public function getActivo() : bool{
        return $this->activo;
    }

    public function toArray() : array{
        return[
            "idCarpetaEliminada" => $this->idCarpetaEliminada,
            "idPapelera" => $this->idPapelera,
            "idCarpeta" => $this->idCarpeta,
            "fechaBorradoTemp" => $this->fechaBorradoTemp,
            "borradoTemp" => $this->borradoTemp,
            "fechaBorradoDef" => $this->fechaBorradoDef,
            "borradoDef" => $this->borradoDef,
            "activo" => $this->activo,
        ];
    }
}