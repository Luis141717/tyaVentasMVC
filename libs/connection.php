<?php
namespace Libs;

class Connection
{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $pdo = null;

    private static $_instance = null;

    public function __construct()
    {
        $this->host = env('DB_HOST');
        $this->user = env('DB_USERNAME');
        $this->pass = env('DB_PASSWORD');
        $this->db = env('DB_DATABASE');

        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$_instance == null){
            self::$_instance = new Connection();
        }
        return self::$_instance;
    }

    public function connect()
    {
        try {
            $options = array(
                \PDO::ATTR_PERSISTENT => false,
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            );
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;

            $this->pdo = new \PDO(
                $dsn,
                $this->user,
                $this->pass,
                $options
            );
        } catch (\PDOException $e) {
            myEcho("Error de conexión: " . $e->getMessage());
            throw $e;
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}