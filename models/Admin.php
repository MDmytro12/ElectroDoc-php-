<?php

class Admin{
    #return all information about admin
    public static function getInfoAboutAdmin(){
        $db = Db::getConnection();
        
        $sql = 'select * from users where status = "admin" ';
        
        $result = $db->query($sql);
        $result = $result->fetch_assoc();
        
        $db->close();
        
        return $result;
    }
}

