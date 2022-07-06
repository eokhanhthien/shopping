<?php
class Database {
    public $hostName = "localhost";
    public $username = "root";
    public $password = "";
    public $dbName = "shopping";
    public $conn;

    function __construct(){
        try {
            $this->conn = new PDO("mysql:host=$this->hostName;dbname=$this->dbName", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }
}