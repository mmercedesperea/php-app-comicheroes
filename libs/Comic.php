<?php

class Comic
{
	private $idCom;
	private $nombre;
	private $imagen;
	private $autor;
	private $compra;
	private $isbn;
	private $editorial;
	private $fec_publi;
	private $descripcion;
	private $paginas;
	private $totalPuntuacion;


	public function __construct()
	{ }

	// GETTERS

	public function getIdCom()
	{
		return $this->idCom;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getPortada()

	{
		return $this->imagen;
	}

	public function getAutor()
	{
		return $this->autor;
	}


	public function getCompra()
	{
		return $this->compra;
	}

	public function getIsbn()
	{
		return $this->isbn;
	}

	public function getEditorial()
	{
		return $this->editorial;
	}

	public function getFec_publi()
	{
		return $this->fec_publi;
	}

	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function getPaginas()
	{
		return $this->paginas;
	}

	public function getTotalpuntuation()
	{
		return $this->totalPuntuacion;
	}


	// SETTERS
	public function setIdCom($idCom)
	{
		$this->idCom = $idCom;

		return $this;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}

	public function setPortada($imagen)
	{
		$this->imagen = $imagen;

		return $this;
	}

	public function setAutor($autor)
	{
		$this->autor = $autor;

		return $this;
	}

	public function setCompra($compra)
	{
		$this->compra = $compra;

		return $this;
	}

	public function setIsbn($isbn)
	{
		$this->isbn = $isbn;

		return $this;
	}

	public function setEditorial($editorial)
	{
		$this->editorial = $editorial;

		return $this;
	}

	public function setFec_publi($fec_publi)
	{
		$this->fec_publi = $fec_publi;

		return $this;
	}



	public function setDescripcion($descripcion)
	{
		$this->descripcion = $descripcion;

		return $this;
	}


	public function setPaginas($paginas)
	{
		$this->paginas = $paginas;

		return $this;
	}


	public function setTotalpuntuation($totalPuntuacion)
	{
		$this->totalPuntuacion =$totalPuntuacion;
		return $this;
	}
}
