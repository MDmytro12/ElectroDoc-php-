<?php

class Document{
    #return all information about all documents
    public static function getAllDocumentInfo(){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string(trim($_SESSION['id']));
        
        $sql = "select * from docs;";
        
        $query = $db->query($sql);
        
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
    #rewriting of masive with status of browsed
    public static function checkCorrectBrowsedMassive(){
        $db = Db::getConnection();
        
        $sql = 'select id , browsed from docs ;';
        $result = $db->query($sql);
        
        $allDocumentInfo = $result->fetch_all(MYSQLI_ASSOC);
        
        $sql = 'select id , browsed from users;';
        $result = $db->query($sql);
        
        $allUserInfo = $result->fetch_all(MYSQLI_ASSOC);
        
        $countOfUser = (int)User::getCountOfAllUsers();
        $countOfDocument = (int)Document::getCountOfAllDocument();
        
        if($countOfUser > count(explode(',',$allDocumentInfo[0]['browsed']))){
            $countOfNewUser = $countOfUser - count(explode(',',$allDocumentInfo[0]['browsed']));
            
            foreach($allDocumentInfo as $item_docs){
                $new_variable = explode(',',$item_docs['browsed']);
                
                for($i =  0 ; $i < $countOfNewUser ; $i++ ){
                    array_push($new_variable , '0');
                }
                $id = $db->real_escape_string($item_docs['id']);
                $browsed = $db->real_escape_string(implode(',',$new_variable));
                $sql = "update docs set `browsed` = '$browsed' where `id` = '$id'";
                $result = $db->query($sql);
            }
            
        }
        $emptyUser = [] ;
            
        foreach($allUserInfo as $index => $item_u){
            if(strlen($item_u['browsed']) == 0){
                array_push($emptyUser , $index);
            }
            
        }

        if(count($emptyUser) != 0 ){
            foreach($emptyUser as $item){
                $masive = [];
                for($i=0;$i<$countOfDocument;$i++){
                    array_push($masive , '0');
                }
                $masive = implode(',',$masive);
                $allUserInfo[$item]['browsed'] = $masive;
                $id = $db->real_escape_string($allUserInfo[$item]['id']);
                $sql = "update users set `browsed` = '$masive' ";
                $result = $db->query($sql);
            }
        }
        
        $emptyUser = [];
        
        foreach($allUserInfo as $index => $item){
            if($countOfDocument > count(explode(',',$item['browsed']))){
                array_push($emptyUser , $index);
            }
        }
        
        if(count($emptyUser) != 0){
            foreach ($emptyUser as $item){
                $diferent = $countOfDocument - count(explode(',',$item['browsed']));
                $id = $db->real_escape_string($item['id']);
                $masive = explode(',',$item['browsed']) ;
                
                for($i=0 ; $i<$diferent ; $i++){
                    array_push($masive , '0');
                }
                $masive = implode(',',$masive);
                $sql = "update users set `browsed` = '$masive' where `id` = '$id' ";
                $result = $db->query($sql);
            }
        }
        
        return true;
    }
    #return the count of all document
    public static function getCountOfAllDocument(){
        $db = Db::getConnection();
        
        $sql = 'select count(id) as count from docs';
        $result = $db->query($sql);
        
        return $result->fetch_assoc()['count'];
    }
}
