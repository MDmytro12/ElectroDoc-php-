<?php

class Announce{
    #return all information about announces
    public static function getAllAnnounceInfo(){
        $db = Db::getConnection();
        
        $sql = 'select * from announces ;';
        
        $result = $db->query($sql);
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    #add new announce to database
    public static function addNewAnnounce($author , $content){
        $db = Db::getConnection();
        
        $author = $db->real_escape_string(trim($author));
        $content = $db->real_escape_string(trim($content));
        
        $sql = "insert into announces values(default,'$author','$content',default,'browsed') ";
        $db->query($sql);
        
        $db->close();
    }
    #return count of all announce
    public static function getCountOfAllAnnounce(){
        $db = Db::getConnection();
        
        $sql = 'select count(id) as count from announces';
        
        $result = $db->query($sql);
        $db->close();
        
        return $result->fetch_assoc()['count'];
    }
    #deleting announce from database
    public static function deleteAnnounceById($id){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string(trim($id));
        $sql = "delete from announces where `id` = $id ";
        
        $db->query($sql);
        $db->close();
    }
}
