<?php

class SiteController
{
    public function actionIndex(){
        $resultOfCheck = User::checkUser();
        
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
            if(User::getStatus()=='user'){
                header('Location: user/cab');
            } 
            if(User::getStatus() == 'admin'){
                header('Location: admin/cab');
            }
        }else{
            require_once(ROOT.'/views/site/login.php');
        }
        
    }
}
//https://github.com/MDmytro12/qw.git