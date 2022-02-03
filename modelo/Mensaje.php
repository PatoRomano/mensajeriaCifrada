<?php

class Mensaje {

    private $descripcion;
    private $idAutor;
    private $idDestinatario;
    private $desplazamiento;

    public function __construct($descripcion,$idAutor,$idDestinatario,$desplazamiento) {
        $this->setDescripcion($descripcion);
        $this->setIdAutor($idAutor);
        $this->setIdDestinatario($idDestinatario);
        $this->setDesplazamiento($desplazamiento);
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getIdAutor()
    {
        return $this->idAutor;
    }

    public function setIdAutor($idAutor)
    {
        $this->idAutor = $idAutor;
    }

    public function getIdDestinatario()
    {
        return $this->idDestinatario;
    }

    public function setIdDestinatario($idDestinatario)
    {
        $this->idDestinatario = $idDestinatario;
    }

    public function getDesplazamiento()
    {
        return $this->desplazamiento;
    }

    public function setDesplazamiento($desplazamiento)
    {
        $this->desplazamiento = $desplazamiento;
    }

}

?>