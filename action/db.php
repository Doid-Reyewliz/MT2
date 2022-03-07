<?php
class Dbase{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "sneaker";
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
            // printf("Error: %s\n", mysqli_error($this->conn));
        }
        if(!empty($resultset)){
            return $resultset;
        }
    }
    function sql($sql){
        $result = mysqli_query($this->conn, $sql);
        // printf("Error: %s\n", mysqli_error($this->conn));
        
        if($result == TRUE){
            return $result;
        }
    }
}
?>