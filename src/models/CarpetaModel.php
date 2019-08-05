<?php

namespace Models;

class CarpetaModel{
    private $idCarpeta;
    private $idNube;
    private $nombreCarpeta;
    private $pathCarpeta;
    private $fechaCreacion;
    private $activo;

    public function construir(String $idCarpeta, string $idNube, string $nombreCarpeta, string $pathCarpeta, string $fechaCreacion, bool $activo){
        $this->idCarpeta =$idCarpeta;
        $this->idNube = $idNube;
        $this->nombreCarpeta = $nombreCarpeta;
        $this->pathCarpeta = $pathCarpeta;
        $this->fechaCreacion = $fechaCreacion;
        $this->activo = $activo;
    }

    public function setIdCarpeta(string $idCarpeta):void{
        $this->idCarpeta = $idCarpeta;
    }

    public function getIdCarpeta() : string{
        return $this->idCarpeta;
    }

    public function setIdNube(string $idNube) : void{
        $this->idNube = $idNube;
    }

    public function getIdNube() : string{
        return $this->idNube;
    }
    
    public function setNombreCarpeta(string $nombreCarpeta) : void{
        $this->nombreCarpeta = $nombreCarpeta;
    }

    public function getNombreCarpeta() : string{
        return $this->nombreCarpeta;
    }

    public function setPathCarpeta(string $pathCarpeta) : void{
        $this->pathCarpeta = $pathCarpeta;
    }

    public function getPathCarpeta() : string{
        return $this->pathCarpeta;
    }

    public function setFechaCreacion(string $fechaCreacion) : void{
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getFechaCreacion() : string{
        return $this->fechaCreacion;
    }

    public function getActivo() : bool{
        return $this->activo;
    }

    public function setActivo(bool $activo) : void {
        $this->activo = $activo;
    }

    public function toArray() : array{
        return [
            "idCarpeta" => $this->idCarpeta,
            "idNube" => $this->idNube,
            "nombreCarpeta" => $this->nombreCarpeta,
            "pathCarpeta" => $this->pathCarpeta,
            "fechaCreacion" => $this->fechaCreacion,
            "activo" => $this->activo,
        ];
    }

}