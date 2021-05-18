<?php

class UserController{
    public function actionCabinet(){
        if(User::checkLogging()){
            $_SESSION['user_btn'] = 'doc' ;
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
            $_SESSION['user_btn'] = 'ann';
            require_once(ROOT.'/views/user/add_ann.php'); 
        }else{
            header('Location: /');
        }
        
    }
    
}

