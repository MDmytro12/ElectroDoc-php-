<?php

class Announce{
    public static function getAllAnnounceInfo(){
        $db = Db::getConnection();
        
        $sql = 'select * from announces ;';
        
        $result = $db->query($sql);
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
