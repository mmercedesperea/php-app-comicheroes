<?php

// importamos librerias
require_once("DatabasePDO.php");
require_once("Usuario.php");
require_once("Usu_comic.php");

class Sesion
{
	private $sesionDatos; // para guardar los datos que queremos en la sesion
	private $usu_comics; // Guardamos los datos del usuario con sus comics
	private $usuLogueado; // traer datos usuario logueado
	private $time_expire = 7200; // Tiempo en segundos para ver cuando expirara nuestra sesion (le he dejado 2 horas)
	// para instanciar la clase para el uso de SINGLENTON private y static
	private static $instancia = null;


	private function __construct()
	{ }

	// Hacemos privado el método para evitar clonaciones
	private function __clone()
	{ }

	// GETTERS

	public function getSesion()
	{
		return $this->sesionDatos;
	}

	public function getUsuLogueado()
	{
		return $this->usuLogueado;
	}

	public function getUsu_com()
	{
		return $this->usu_comics;
	}

	// Utilizo un patron SINGLETON para tener una unica instancia
	public static function getInstance()
	{
		// crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
		session_start();

		// si la variable no esta a nulo
		if (isset($_SESSION["_sesion"])) {
			// creamos una instancia  usando : unserialize() toma una única variable serializada y la vuelve a convertir a un valor de PHP.
			self::$instancia = unserialize($_SESSION["_sesion"]);
		} else { // si esta a nulo creamos una nueva sesion
			if (self::$instancia === null) {
				self::$instancia = new Sesion();
			}
		}
		// devolvemos la instancia
		return self::$instancia;
	}


	// FUNCIONES / METODOS relacionados con acciones dependientes de la sesion

	public function login(string $ema, string $pas): bool
	{
		$db = Database::getInstance();

		if ($db->query("SELECT idUsu,admin FROM usuario Where email=? AND pass=?;", [$ema, $pas])) {

			// rescatar la información del usuario que queremos en la sesion (solo el id en este caso)
			$this->sesionDatos = $db->getObject("Usuario");

			// si el usuario es correcto, iniciamos la sesión, guardamos el tiempo, 
			// y serializamos la informacion generando un valor almacenable por nuestra session.
			$_SESSION["time"] = time();
			$_SESSION["_sesion"] = serialize(self::$instancia);

			// Si la sesión se ha iniciado return true
			return true;
		}

		// la sesión no se ha iniciado
		return false;
	}

	// FUncion para comprobar si se ha expirado o no el tiempo
	public function isExpired(): bool
	{
		// Comprobamos si el tiempo de la sesion es mayor que al tiempo de expiracion 
		$expirado = time() - $_SESSION["time"] > $this->time_expire;

		return $expirado;
	}

	// Funcion para comprobar que el usuario sigue logueado (Osea que no esta vacia la variable session)
	public function isLogged(): bool
	{
		return !empty($_SESSION);
	}

	// PAra comprobar que la session esta activa, si is Logged es true y el tiempo de expiracion no se ha pasado devuelve true
	public function checkActiveSession(): bool
	{
		if ($this->isLogged())
			if (!$this->isExpired()) return true;

		return false;
	}

	// Funcion redirije al usuario a una url asignada
	public function redirect(string $url)
	{
		header("Location: $url");
		die();
	}

	// __sleep() método se ejecuta antes de cualquier serialización. 
	// Se puede limpiar el objeto y se supone que devuelve un array con los nombres 
	// de todas las variables de el objeto que se va a serializar. 
	public function __sleep()
	{
		return ["sesionDatos", "instancia"];
	}

	// Funcion para cerrar nuestra sesion
	public function close()
	{
		// vaciamos las variables de sesión
		$_SESSION = [];

		// destruir la sesión
		session_destroy();
	}


	// Funcion para actualizar al usuario
	public function updateUser(Usuario $usr)
	{
		$db = Database::getInstance();

		// Se guardan los datos en variables
		$id = $usr->getIdUsu();
		$nom = $usr->getNombre();
		$img = $usr->getFoto();
		$fe = $usr->getFec_nacimiento();
		$ape = $usr->getApellidos();
		$ema = $usr->getEmail();
		$pa = $usr->getPass();

		// Se actualiza el usuario en la base de datos
		$db->query("UPDATE usuario SET email=?, pass=?, nombre=?, apellidos=?, fec_nacimiento=?, foto=? WHERE idUsu=?", [$ema, $pa, $nom, $ape, $fe, $img, $id]);
	}

	// Para borrar el usuario
	public function deleteUser($usr)
	{
		$db = Database::getInstance();

		// Se guarda la id en una variable
		$id = $usr->getIdUsu();

		// Como la id sel usuario aparece en otra tabla como clave compuesta de su PK primero tenemos que eliminar todo rastro del usuario de esta tabla
		$db->query("DELETE FROM usu_comic WHERE idUsu=?", [$id]);

		// una vez eliminado los datos de la tabla de la que forma PK nuestro usuario, podemos eliminarlo de la BD
		$db->query("DELETE FROM usuario WHERE idUsu=?", [$id]);
	}

	// Funcion para traer a el usuario que esta logueado
	public function userLoged($idUsu)
	{

		$db = Database::getInstance();

		$db->query("SELECT * from usuario where idUsu=?", [$idUsu]);

		$this->usuLogueado = $db->getObject("Usuario");

		return $this->usuLogueado;
	}

	// Añadir a la lista de usuarios comics
	public function listUsuCom($usr, $idCom)
	{
		$db = Database::getInstance();

		$db->query("INSERT INTO usu_comic (idUsu,idCom)  VALUES (?, ?); ", [$usr, $idCom]);
	}

	// Para traer la informacion de la tabla usuario comics
	public function Usu_comic($usr, $idCom)
	{
		$db = Database::getInstance();

		// SI la query trae resultado devuelve true
		if ($db->query("SELECT * FROM usu_comic WHERE idUsu=? AND idCom=?", [$usr, $idCom])) {

			// Guardamos como un objeto la informacion resultante 
			$this->usu_comics = $db->getObject("UsuComic");
			return true;
		}

		// Si no devuelve false
		return false;
	}


	// Añadir el estado a la tabla comic_usuarios
	public function comSTATUS($idUsu, $idCom, $estado)
	{
		$db = Database::getInstance();

		// Si no tenemos informacion sobre ese usuario con ese comic en la BD
		if ($this->usu_comics == NULL) {
			// Ejecutamos la sentencia para insertar la informacion correspondiente
			$db->query(
				"INSERT INTO usu_comic (idUsu,idCom,estado)  VALUES (?, ?,?); ",
				[$idUsu, $idCom, $estado]
			);
			// si tenemos ya informacion del usuario con ese comic hacemos un update
		} else {
			$db->query(
				"UPDATE usu_comic SET estado=?  WHERE idUsu=? AND idCom=?",
				[$estado, $idUsu, $idCom]
			);
		}
	}

	// Funcion para comentar un comic
	public function comentCom($idUsu, $idCom, $coment)
	{
		$db = Database::getInstance();

		// hacemos un update ya que el campo contendra informacion de base 
		$db->query(
			"UPDATE usu_comic SET comentario=?  WHERE idUsu=? AND idCom=?",
			[$coment, $idUsu, $idCom]
		);
	}

	// Funcion para eliminar un comic de la lista del usuario
	public function deleteUsuCom($idUsu, $idCom)
	{
		$db = Database::getInstance();

		$db->query(
			"DELETE FROM usu_comic WHERE idUsu=? AND idCom=?",
			[$idUsu, $idCom]
		);
	}

	// Funcion para votar un comic
	public function voteCom($idUsu, $idCom, $vote)
	{
		$db = Database::getInstance();

		$db->query(
			"UPDATE usu_comic SET puntuacion=?  WHERE idUsu=? AND idCom=?",
			[$vote, $idUsu, $idCom]
		);
	}

	// Funcion para añadir a favoritos por defecto el comic no esta en favorito y habria que actualizar su estado
	public function addFavorite($idUsu, $idCom)
	{
		$db = Database::getInstance();

		$db->query(
			"UPDATE usu_comic SET favorito=1  WHERE idUsu=? AND idCom=?",
			[$idUsu, $idCom]
		);
	}

	// Eliminar de Favorite
	public function delfavorite($idUsu, $idCom)
	{
		$db = Database::getInstance();

		$db->query(
			"UPDATE usu_comic SET favorito=0  WHERE idUsu=? AND idCom=?",
			[$idUsu, $idCom]
		);
	}
}
