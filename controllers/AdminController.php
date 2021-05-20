<?php

class AdminController{
    public function actionCabinet(){
        
       if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
           $adminInfo = Admin::getInfoAboutAdmin();
           
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
        echo 'Administrate!';
    }
    public function actionAddAnnounce(){
        echo 'Add announce!';
    }
}

