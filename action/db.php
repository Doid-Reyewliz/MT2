<?php
class Dbase{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "final";
    private $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }

    function query($query){
        $result = mysqli_query($this->conn, $query);
        while($row = mysqli_fetch_assoc($result)){
            $resultset[] = $row;
        }
        if(!empty($resultset)){
            return $resultset;
        }
    }
    function sql($sqli){
        $result = mysqli_query($this->conn, $sqli);

        if($result == TRUE){
            return $result;
        }
    }
    function prepare($sql){
        $result = mysqli_prepare($this->conn, $sql);

        return $result;
    }
}
?>