<?php
namespace App\Config;


class Db {
    private $host = "127.0.0.1";
    private $databaseName = "hrapp";
    private $username = "root";
    private $password = "root";

    public $conn;

    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->databaseName, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}  