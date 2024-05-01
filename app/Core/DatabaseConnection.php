<?php 

namespace App\Core;

use \PDO;
use \PDOException;

class DatabaseConnection {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $connection;

    private static $instance;

    public function __construct(string $host, string $dbname, string $username, string $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect(): bool
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    static function query($sql) {
        $instance = self::$instance;

        try {
            $statement = $instance->connection->query($sql);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    public static function getInstance(string $host, string $dbname, string $username, string $password)
    {
        if (! self::$instance) {
            self::$instance = new self($host, $dbname, $username, $password);
        }

        return self::$instance;
    }


}