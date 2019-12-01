<?php

class Database
{
    // Atributos
    private $host = "localhost";
    private $dbName = "comicheroes";
    private $dbuser = "root";
    private $dbPass = "";

    // $db = Database::getInstance("root", "", "comicheroes");

    // En pdo almacenaremos nuestra conexion con la BD y tiene que ser privado para evitar alteraciones 
    private $pdo  = null;
    private $result = null;
    // para instanciar la clase para el uso de SINGLENTON private y static
    private static $instance = null;

    // Constructor de la clase DatabasePDO
    // public function __construct($dbu, $dbp, $dbn)
    public function __construct()
    {
        // // Inicializamos la conexion 
        // $this->dbName = $dbn;
        // $this->dbuser = $dbu;
        // $this->dbPass = $dbp;

        // Una vez iniciamos el elemento nos conectamos con la funcion connect
        $this->connect();
    }

    // Destructor de la clase
    public function __destruct()
    {
        $this->pdo = null;
    }

    // Utilizo un patron SINGLETON para  tener una unica instancia de la clase DATABASEPDO.
    public static function getInstance()
    {   // si no existe instancia la creamos
        if (Database::$instance == null)
            Database::$instance = new Database();
        // devolvemos la instancia 
        return Database::$instance;
    }

    // Hacemos privado el método para evitar clonaciones
    private function __clone()
    { }

    // Establecer una conexión con la BD
    private function connect()
    {
        // Intentamos conectamor
        try {
            // almacenamos en la variable pdo nuestra conexion
            $this->pdo = new PDO("mysql:host=$this->host; dbname=$this->dbName", "$this->dbuser", "$this->dbPass");
            // Si tenemos un error muestralo
        } catch (PDOException $excpt) {
            die("**ERROR: " . $excpt->getMessage());
        }
    }

    // Realizamos una consulta y devolvemos true si la consulta se ha realizado con exito o false en caso de error.
    public function query($sql, $params = [])
    {
        //Preparamos la consulta
        $this->result = $this->pdo->prepare($sql);

        // Ejecutamos la consulta con los parametros y almacenamos el resultado
        if ($this->result->execute($params)) {
            // si el execute nos trae mas de una fila (osea que se ha podido hacer la consulta)
            if ($this->result->rowCount()  > 0) {
                // devuelve true
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    // Devuelve el resultado de la consulta en formato de objeto
    public function getObject($cls = "StdClass") // se le pasa el nombre de la clase que se quiere
    {
        // si no tenemos resultado osea que resultado es null devolvemos null
        if (is_null($this->result)) return null;
        // si tenemos un resultado lo devolvemos. 
        // Con fetchObject cuando se obtiene un objeto, las propiedades de este objeto se asignan a nuestro resultado y se invoca a su constructor
        return $this->result->fetchObject($cls);
    }

    //  __wakeup tiene como objetivo restablecer las conexiones de base de datos que se puedan haber perdido durante la 
    // serialización y realizar otras tareas de reinicialización
    public function __wakeup()
    {
        $this->connect();
    }

    // Para obtener el numero de columnas de nuestro resultado
    public function getNumRows(): int
    {
        // rowCount — Devuelve el número de filas afectadas por la última sentencia 
        return $this->result->rowCount();
    }
}
