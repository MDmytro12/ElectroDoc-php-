<?php
class Db{
    public static function getConnection(){
        
        $servername = "localhost";
        $username = "root";
        $password = "123456";
        $dbname = "electrodoc";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset('utf8');
        
        return $conn;
    }
}