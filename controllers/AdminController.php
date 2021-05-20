<?php

class AdminController{
    public function actionCabinet(){
        
       if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
           $adminInfo = Admin::getInfoAboutAdmin();
           $documentInfo = Document::getAllDocumentInfo();
           $announceInfo = Announce::getAllAnnounceInfo();
           $doc_ann = 'doc';
           
           require_once(ROOT.'/views/admin/cabinet.php');
       }else{
           header('Location: /');
       }    
    }
    public function actionLogout(){
        unset($_SESSION['id']);
        header('Location: /');
    }
    public function actionAdministrate(){
        if(User::checkLogging()){
            $adminInfo = Admin::getInfoAboutAdmin();
            
            require_once(ROOT.'/views/admin/ad_add.php');
        }
    }
    public function actionAddAnnounce(){
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
            $adminInfo = Admin::getInfoAboutAdmin();
            $doc_ann = 'ann';
            $send = false ;
            $noUserName = false;
            
            if(isset($_POST['name']) and !empty($_POST['name']) and !empty($_POST['content'])){
                $author = $_POST['name'];
                $content = $_POST['content'];
                
                
                
                if($author == 'chif_of_drill_departure'){
                    Announce::addNewAnnounce($author, $content);
                    $send = true;
                }else{
                    $noUserName = true;
                }          
            }
            
            require_once(ROOT.'/views/admin/add_ann.php');
        }else{
            header("Location: /");
        }
    }
    public function actionChangeDocument(){
        echo 'Change document!';
    }
    public function actionDeleteDocument(){
        echo 'Delete document!';
    }
}

