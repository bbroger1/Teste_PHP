<?php

class Connection
{
    private string $host = "127.0.0.1";
    private string $database = "find_user";
    private string $username = "root";
    private string $password = "";
    private array $options = [];

    public function __constructor($host, $database, $username, $password, $options)
    {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }

    public function connection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=UTF8";

        try {
            $this->options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            return new PDO($dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
