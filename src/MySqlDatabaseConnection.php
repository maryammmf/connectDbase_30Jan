<?php

class MySqlDatabaseConnection implements DatabaseConnectionInterface {

    private string $dns;
    private string $username;
    private string $password;
    private static ?MySqlDatabaseConnection $instance = null;
    private PDO $pdo;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        self::$instance = self::$instance == null ? new MySqlDatabaseConnection() : self::$instance;
        return self::$instance;
    }


    public function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }


    public function getPdo(): PDO
    {
        return $this->pdo;
    }

}