<?php

namespace Models;

class CarpetaModel{
    private $idCarpeta;
    private $idNube;
    private $nombreCarpeta;
    private $pathCarpeta;
    private $fechaCreacion;

    public function __construct(int $idCarpeta, int $idNube, string $nombreCarpeta, string $pathCarpeta, string $fechaCreacion){
        $this->idCarpeta =$idCarpeta;
        $this->idNube;
        $this->nombreCarpeta = $nombreCarpeta;
        $this->pathCarpeta = $pathCarpeta;
        $this->fechaCreacion;
    }

    public function setIdCarpeta(int $idCarpeta):void{
        $this->idCarpeta = $idCarpeta;
    }

    public function getIdCarpeta() : int{
        return $this->idCarpeta;
    }

    public function setIdNube(int $idNube) : void{
        $this->idNube = $idNube;
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

    public function toJSON() : array{
        return [
            "id_carpeta" => $this->idCarpeta,
            "id_nube" => $this->idNube,
            "nombre_carpeta" => $this->nombreCarpeta,
            "path_carpeta" => $this->pathCarpeta,
            "fecha_creacion" => $this->fechaCreacion,
        ];
    }

}