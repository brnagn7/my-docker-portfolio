<?php

class Database {
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct() {
        $this->host = 'db';         // Docker service name
        $this->port = '3306';       // Internal MySQL port
        $this->dbname = getenv('MYSQL_DATABASE') ?: 'docker_php';
        $this->username = getenv('MYSQL_USER') ?: 'docker_user';
        $this->password = getenv('MYSQL_PASSWORD') ?: 'secret';
    }

    public function connect() {
        try {
            if (!$this->pdo) {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_TIMEOUT => 5
                ];
                $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
            }
            return $this->pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage() . 
                "<br>DSN: mysql:host={$this->host};port={$this->port};dbname={$this->dbname}");
        }
    }
} 