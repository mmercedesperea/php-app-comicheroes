<?php

require_once("DatabasePDO.php");

class Usuario
{
    private $idUsu;
    private $email;
    private $pass;
    private $nombre;
    private $apellidos;
    private $fec_nacimiento;
    private $foto;
    private $admin;

    public function __construct()
    { }

    //GETTERS
    public function getIdUsu()
    {
        return $this->idUsu;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getFec_nacimiento()
    {
        return $this->fec_nacimiento;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    //SETTERS

    public function setIdUsu($idUsu)
    {
        $this->idUsu = $idUsu;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setFec_nacimiento($fec_nacimiento)
    {
        $this->fec_nacimiento = $fec_nacimiento;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setAdmin($admin)
    {
        $this->foto = $admin;
    }
}
