<?php

class UserController{
    public function actionCabinet(){
        if(User::checkLogging()){
            $doc_ann = 'doc' ;
            
            Document::checkCorrectBrowsedMassive();
            
            $userInfo = User::getAllUserInfo();
            $documentInfo = Document::getAllDocumentInfo();
            $announceInfo = Announce::getAllAnnounceInfo();
            $allUserInfo = User::getAllUserInfo1();
            $newMessage = User::getNewMessage();
            
            $userCount = 0 ;
            for($i = 0 ; $i < count($allUserInfo) ; $i++ ){
                if($allUserInfo[$i]['id'] == $_SESSION['id']){
                    $userCount = $i;
                    $thisUser = $allUserInfo[$i];
                    break;
                }
            }
            
            $whosee = [];
            
            foreach($documentInfo as $doc){
                $masive = json_decode($doc['who_see']);
                foreach($masive as $item){
                    array_push($whosee , $item);
                }
            }
            
            require_once(ROOT.'/views/user/cabinet.php'); 
        }else{
            header('Location: /');
        }
    }

    public function actionLogout(){
        unset($_SESSION['id']);
        header('Location: /');
    }
    
    public function actionAddAnnounce(){
        if(User::checkLogging()){
            $doc_ann = 'ann';
            $send = false ;
            $noUserName = false;
            $newMessage = User::getNewMessage();
            
            if(isset($_POST['name']) and !empty($_POST['name']) and !empty($_POST['content'])){
                $author = $_POST['name'];
                $content = $_POST['content'];
                
                $resultOfCheck = User::checkUserName($author);
                print($resultOfCheck);
                if($resultOfCheck){
                    Announce::addNewAnnounce($author, $content);
                    $send = true;
                }else{
                    $noUserName = true;
                }          
            }
            
            $userInfo = User::getAllUserInfo(); 
            
            require_once(ROOT.'/views/user/add_ann.php'); 
        }else{
            header('Location: /');
        }
        
    }
    
    public function actionBrowsed(){
        
        if(isset($_POST['browsedCount'])){
            $db = Db::getConnection();
            $idBr = $_POST['browsedCount'];
            $allDocumentInfo = Document::getAllDocumentInfo();
            $user = User::getUserById($_SESSION['id']);
            
            #delete 1 from new 
            
            User::subOneFromNew($_SESSION['id'], '-');
            
            #get users browsed
            
            $user['browsed'] = explode(',',$user['browsed']);
            
            $count = 0;
            for($i = 0 ; $i < count($allDocumentInfo) ; $i++){
                if($allDocumentInfo[$i]['id'] == $idBr ){
                    $count = $i;
                    break;
                }
            }
            
            $user['browsed'][$count] = 1;
            
            $user['browsed'] = implode(',' , $user['browsed']);
            $id = $db->real_escape_string($_SESSION['id']);
            
            $browsed = $db->real_escape_string($user['browsed']);
            $sql = "update users set browsed = '$browsed' where id = $id ";
            
            $db->query($sql);
            
            #get document browsed
            
            $document = false ;
            for($i = 0 ; $i < count($allDocumentInfo) ; $i++){
                if($allDocumentInfo[$i]['id']  == $idBr ){
                    $document = $allDocumentInfo[$i];
                }
            }
            
            $allUserInfo = User::getAllUserInfo1();
            $count = 0;
            
            for($i =  0; $i < count($allUserInfo) ; $i++){
                if($allUserInfo[$i]['id'] == $_SESSION['id']){
                    $count = $i;
                }
            }   
            
            $document['browsed'] = json_decode($document['browsed']);
            
            $document['browsed'][$count] = 1;
            
            $document['browsed'] = json_encode($document['browsed']);
            $document = $db->real_escape_string(trim($document['browsed']));
            
            $sql = "update docs set browsed = '$document' where id = $idBr  ";
            
            $db->query($sql);
            $db->close();
            
            
            echo $idBr ;
        }else{
            echo 'false';
        }
    }
    
}

