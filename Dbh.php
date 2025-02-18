<?php

class Dbh
{
    private $host = "localhost";
    private $port = "3307";
    private $dbname = "db_cars";
    private $dbusername = "root";
    private $dbpassword = "";

    protected function connect()
    {
        try {
            $pdo =  new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname, $this->dbusername, $this->dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException  $e) {
            die("Connection Failed:" . $e->getMessage());
        }
    }
}
