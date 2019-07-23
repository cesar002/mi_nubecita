<?php

namespace Models;

class ArchivoModel{
    private $idArchivo;
    private $idCarpeta;
    private $nombreArchivo;
    private $tipoArchivo;
    private $size;
    private $fechaSubida;

    public function construir(int $idArchivo, int $idCarpeta, string $nombreArchivo, string $tipoArchivo, string $size, string $fechaSubida){
        $this->idArchivo = $idArchivo;
        $this->idCarpeta = $idCarpeta;
        $this->nombreArchivo = $nombreArchivo;
        $this->tipoArchivo = $tipoArchivo;
        $this->size = $size;
        $this->fechaSubida = $fechaSubida;
    }

    public function setIdArchivo(int $idArchivo) : void{
        $this->idArchivo = $idArchivo;
    }

    public function getIdArchivo() : int {
        return $this->idArchivo;
    }

    public function setIdCarpeta(int $idCarpeta) : void{
        $this->idCarpeta = $idCarpeta;
    }

    public function getIdCarpeta() : int{
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

    public function setSize(string $size) : void{
        $this->size = $size;
    }

    public function getSize() : string{
        return $this->size;
    }

    public function setFechaSubida(string $fechaSubida) : void{
        $this->fechaSubida = $fechaSubida;
    }

    public function getFechaSubida() : string{
        return $this->fechaSubida;
    }

    public function toArray() : array{
        return [
            "id_archivo" => $this->idArchivo,
            "id_carpeta" => $this->idCarpeta,
            "nombre_archivo" => $this->nombreArchivo,
            "tipo_archivo" => $this->tipoArchivo,
            "size" => $this->size,
            "fecha_subida" => $this->fechaSubida,
        ];
    }

}