<?php   

namespace Models;

class ArchivoEliminadoModel{
    private $idArchivoEliminado;
    private $idPapelera;
    private $idArchivo;
    private $fechaBorradoTemp;
    private $borradoTemp;
    private $fechaBorradoDef;
    private $borradoDef;
    private $activo;

    public function construir(int $idArchivoEliminado, int $idPapelera, int $idArchivo, string $fechaBorradoTemp, bool $borradoTemp, string $fechaBorradoDef, bool $borradoDef, bool $activo){
        $this->idArchivoEliminado = $idArchivoEliminado;
        $this->idPapelera = $idPapelera;
        $this->idArchivo = $idArchivo;
        $this->fechaBorradoTemp =  $fechaBorradoTemp;
        $this->borradoTemp = $borradoTemp;
        $this->fechaBorradoDef = $fechaBorradoDef;
        $this->borradoDef = $borradoDef;
        $this->activo = $activo;
    }

    public function setIdArchivoEliminado(int $idArchivoEliminado) : void{
        $this->idArchivoEliminado = $idArchivoEliminado;
    }

    public function getIdArchivoEliminado() : int{
        return $this->idArchivoEliminado;
    }

    public function setIdPapelera(int $idPapelera) : void{
        $this->idPapelera = $idPapelera;
    }

    public function getIdPapelera() : int{
        return $this->idPapelera;
    }

    public function setIdArchivo(int $idArchivo) : void{
        $this->idArchivo = $idArchivo;
    }

    public function getIdArchivo() : int{
        return $this->idArchivo;
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
            "id_archivo_eliminado" => $this->idArchivoEliminado,
            "id_papelera" => $this->idPapelera,
            "id_archivo" => $this->idArchivo,
            "fecha_borrado_temp" => $this->fechaBorradoTemp,
            "borrado_temp" => $this->borradoTemp,
            "fecha_borrado_def" => $this->fechaBorradoDef,
            "borrado_def" => $this->borradoDef,
            "activo" => $this->activo,
        ];
    }

}