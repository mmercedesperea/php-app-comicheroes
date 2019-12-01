<?php

class UsuComic
{
    private $idUsu;
    private $idCom;
    private $estado;
    private $puntuacion;
    private $comentario;
    private $favorito;

    public function __construct()
    { }

    // GETTERS 

    public function getidUsu()
    {
        return $this->idUsu;
    }

    public function getIdCom()
    {
        return $this->idCom;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getFavorito()
    {
        return $this->favorito;
    }

    // SETTERS

    public function setIdUsu($idUsu)
    {
        $this->idUsu = $idUsu;
    }

    public function setIdCom($idCom)
    {
        $this->idCom = $idCom;

        return $this;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    public function setComentario($comentario)
    {
        $this->comentarion = $comentario;

        return $this;
    }

    public function setFavorito($favorito)
    {
        $this->favorito = $favorito;

        return $this;
    }
}
