<?php

class Document{
    #return all information about all documents
    public static function getAllDocumentInfo(){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string(trim($_SESSION['id']));
        
        $sql = "select * from docs;";
        
        $query = $db->query($sql);
        
//        $result = array();
//        $count = 0;
//        
//        while($row = $query->fetch_assoc()){
//            $result[$count]['id'] = $row['id'];
//            $result[$count]['author'] = $row['author'];
//            $result[$count]['content'] = $row['content'];
//            $result[$count]['img_path'] = $row['img_path'];
//            $result[$count]['date_publish'] = $row['date_publish'];
//            $result[$count]['browsed'] = $row['browsed'];
//            $count++;
//        }
       
        
        return $query->fetch_all(MYSQLI_ASSOC);
    }
    #reutrn path to document photo 
    public static function getImage($id){
        $noPath = '/uploades/img/docs/doc.png';
        
        $yesPath = "/uploades/img/docs/doc_$id.png";
        
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$yesPath)){
            return $yesPath;
        }
        
        return $noPath;
    }
    #return correct type of date
    public static function getCorrectDate($date){
        
        $date = explode(' ',$date);
        $date = explode('-', $date[0]);
        
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        
        switch ((int)$month){
            case 1 :
                $month = ' січня ';
                break;
            case 2 :
                $month = ' лютого ';
                break;
            case 3 : 
                $month = ' березня ';
                break;
            case 4 : 
                $month = ' квітня ';
                break;
            case 5 :
                $month = ' травня ';
                break;
            case 6 :
                $month = ' червня ';
                break;
            case 7 : 
                $month = ' липня ';
                break;
            case 8 :
                $month = ' серпня ';
                break;
            case 9 :
                $month = ' вересня ';
                break;
            case 10 :
                $month = ' жовтня ';
                break;
            case 11 :
                $month = ' листопада ';
                break;
            case 12 : 
                $month = ' грудня ';
                break;
            default :
                $month = ' місяця ';
                break;
        }
        
        return $day.$month.$year.' року.';
    }
}

