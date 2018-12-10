<?php

class Database {

    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "php_webservice";
    private $conn;

    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //echo "conection established";
        }catch(PDOException $e){
           // echo "connection failed ".$e->getMessage();
        }
        return $this->conn;
    }

}


?>