<?php

class UserController{
    public function actionCabinet(){
        if(User::checkLogging()){
            $doc_ann = 'doc' ;
            
            Document::checkCorrectBrowsedMassive();
            
            $userInfo = User::getAllUserInfo();
            $documentInfo = Document::getAllDocumentInfo();
            $announceInfo = Announce::getAllAnnounceInfo();
            
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
    
}

