<?php

namespace Models;

class ArchivoModel{
    private $idArchivo;
    private $idCarpeta;
    private $nombreArchivo;
    private $tipoArchivo;
    private $size;
    private $fechaSubida;
    private $activo;

    public function construir(string $idArchivo, string $idCarpeta, string $nombreArchivo, string $tipoArchivo, int $size, string $fechaSubida, bool $activo){
        $this->idArchivo = $idArchivo;
        $this->idCarpeta = $idCarpeta;
        $this->nombreArchivo = $nombreArchivo;
        $this->tipoArchivo = $tipoArchivo;
        $this->size = $size;
        $this->fechaSubida = $fechaSubida;
        $this->activo = $activo;
    }

    public function setIdArchivo(string $idArchivo) : void{
        $this->idArchivo = $idArchivo;
    }

    public function getIdArchivo() : string {
        return $this->idArchivo;
    }

    public function setIdCarpeta(string $idCarpeta) : void{
        $this->idCarpeta = $idCarpeta;
    }

    public function getIdCarpeta() : string{
        return $this->idCarpeta;
    }

    public function setNombreArchivo(string $nombreArchivo) : void{
        $this->nombreArchivo = $nombreArchivo;
    }
    
    public function getNombreArchivo() : string{
        return $this->nombreArchivo;
    }

    public function setTipoArchivo(string $tipoArchivo) : void{
        $this->tipoArchivo = $tipoArchivo;
    }

    public function getTipoArchivo() : string{
        return $this->tipoArchivo;
    }

    public function setSize(int $size) : void{
        $this->size = $size;
    }

    public function getSize() : int{
        return $this->size;
    }

    public function setFechaSubida(string $fechaSubida) : void{
        $this->fechaSubida = $fechaSubida;
    }

    public function getFechaSubida() : string{
        return $this->fechaSubida;
    }

    public function setActivo(bool $activo) : void{
        $this->activo = $activo;
    }

    public function getActivo() : bool{
        return $this->activo;
    }

    public function toArray() : array{
        return [
            "idArchivo" => $this->idArchivo,
            "idCarpeta" => $this->idCarpeta,
            "nombreArchivo" => $this->nombreArchivo,
            "tipoArchivo" => $this->tipoArchivo,
            "size" => $this->size,
            "fechaSubida" => $this->fechaSubida,
            "activo" => $this->activo,
        ];
    }

}