<?php

include_once "Connection.php";

class Transaction {

    private $conn;
    const table = 'items';

    /*public function createDatebase() :void
    {
        $query = "CREATE DATABASE 'database'";
        if(mysqli_query($link, $query)){
            echo "Success";
        } else {
            echo "Failure";
        }
    }*/

    public function __construct(
    ) {
        $this->conn = new Connection();
    }

    public function createTable() :void
    {
        $newConn = $this->conn->connect(); 
        $query = "CREATE TABLE IF NOT EXISTS ".self::table;
        $query .= " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `text` varchar(255) NOT NULL DEFAULT '',
            `status` int(1) NOT NULL DEFAULT 0,
            `category` varchar(255) NOT NULL DEFAULT '',
            `date` date
        );";

        if($newConn->query($query)){
            //echo "Success";
        } else {
            //echo "Failure";
        }
        $newConn->close();
    }

    public function selectAll(): array
    {
        $result = [];
        $newConn = $this->conn->connect();
        $query = "SELECT id, text, status, date FROM ".self::table;
        $mysqlResult = $newConn->query($query);
        if($mysqlResult){
            //echo "Success";
            while ($row = $mysqlResult->fetch_assoc()) {
                $result[]=$row;
            }
            print_r($result);
            die;
        } else {
            echo "Failure";
        }
        $newConn->close();
        return $result;
    }

}



?>