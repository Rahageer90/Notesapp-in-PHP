<?php

class Database
{
    public $connection;

    public function __construct($config)
    {
        $host = $config['host'];
        $dbname = $config['dbname'];
        $charset = $config['charset'];
        $port = $config['port'];
        $username = $config['user'];       // Use the username from config
        $password = $config['password'];  // Use the password from config

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";

        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetch($query, $params = [])
    {
        return $this->query($query, $params)->fetch();
    }

    public function fetchAll($query, $params = [])
    {
        return $this->query($query, $params)->fetchAll();
    }
}
