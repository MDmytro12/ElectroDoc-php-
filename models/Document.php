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
        $db = Db::getConnection();
        
        $id  = $db->real_escape_string($id);
        $sql = "select img_path , id from docs where id = $id ";
        
        $result = $db->query($sql);
        $result=$result->fetch_assoc();
        
        $countOfImage =$result['img_path'];
        $documentId = $result['id'];
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/docs/');
        array_shift($files);
        array_shift($files);
        
        if($countOfImage == 0 ){
            return '/uploades/img/docs/doc.png';
        }elseif ($countOfImage == 1) {
            foreach($files as $file){
                if(preg_match("~_{$documentId}_0~" , $file)){
                    return '/uploades/img/docs/'.$file;
                }
            }
        }else{
            $masiveOfImages = [];
            
            foreach($files as $file){
                if(preg_match("~_{$documentId}_[0-9]{1,}~" , $file)){
                    array_push($masiveOfImages , '/uploades/img/docs/'.$file);
                }
            }
            
            return $masiveOfImages;
        }
        
        return '/uploades/img/docs/doc.png';
        
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
    #add new record to a database
    public static function addNewDocument($countImg , $content , $author , $whosee ){
        #counting obrowsed 
        
        $masiveBrowsed = array();
        $countOfUser = User::getCountOfAllUsers();
        
        for($i = 0 ; $i < $countOfUser ; $i++ ){
            array_push($masiveBrowsed , '0');
        }
        
        $masiveBrowsed = json_encode($masiveBrowsed);
        
        #adding of record to database
        
        $db = Db::getConnection();
        
        $countImg = $db->real_escape_string(trim($countImg));
        $author = $db->real_escape_string($author);
        $content = $db->real_escape_string(trim($content));
        $masiveBrowsed = $db->real_escape_string($masiveBrowsed);
        $whosee = $db->real_escape_string($whosee);
        
        $sql = "insert into docs values(default , '$author' , '$content' , '$countImg' , default , '$masiveBrowsed' ,  '$whosee' );";
        
        $db->query($sql);   
    }
    #return information about one document by id
    public static function getInfoById($id){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string($id);
        
        $sql = "select * from docs where `id` = $id ";
        
        $result = $db->query($sql);
        
        return $result->fetch_assoc();
    }
    #this method change document by id
    public static function changeDocumentById($id , $date , $author , $content ){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string($id);
        $date = $db->real_escape_string($date);
        $author = $db->real_escape_string($author);
        $content = $db->real_escape_string($content);
        
        $sql = "update docs set `date_publish` = '$date' , `author` = '$author' , `content` = '$content' where `id` = $id  ";
        
        $db->query($sql);
    }
    #transform data in form for database
    public static function dateToDataBase($date){
        $date = explode(' ' , $date);
        $day = $date[0];
        $month = $date[1];
        $year = $date[2];
       
        switch($month){
            case 'січня':
                $month = 1;
                break;
            case 'лютого':
                $month = 2;
                break;
            case 'березня':
                $month = 3;
                break;
            case 'квітня':
                $month = 4;
                break;
            case 'травня':
                $month = 5;
                break;
            case 'червеня':
                $month = 6;
                break;
            case 'липеня':
                $month = 7;
                break;
            case 'серпеня':
                $month = 8;
                break;
            case 'вересня':
                $month = 9;
                break;
            case 'жовтня':
                $month = 10;
                break;
            case 'листопада':
                $month = 11;
                break;
            case 'грудня':
                $month = 12;
                break;
            default:
                $month = 1;
                break;
        }
        
        return $year.'-'.$month.'-'.$day;
    }
    #delete item of document from dataBase
    public static function deleteDocumentById($id){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string(trim($id));
        $sql = "delete from docs where `id` = $id ";
        
        $db->query($sql);
        $id = $db->real_escape_string($_SESSION['id']);
        
        $db->close()    ;
    }
    #return max id 
    public static function getMaxId(){
        $db= Db::getConnection();
        
        $sql = 'select max(id) as max from docs ';
        $result = $db->query($sql);
        
        $db->close();
        return $result->fetch_assoc()['max'];
    }
    #delete not needed images
    public function deleteNotNeededImages(){
        $allImages = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp');
        array_shift($allImages);
        array_shift($allImages);
        
        foreach($allImages as $img){
            unlink($img);
        }
    }
    #delete images after deleting of document
    public static function deleteNoUsefulImages($id){
        $allImages = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/docs/');
        array_shift($allImages);
        array_shift($allImages);
        
        foreach($allImages as $image){
            if(preg_match("~_{$id}_~", $image)){
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploades/img/docs/'.$image);
            }
        }
       
    }
}

