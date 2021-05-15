<?php

class SiteController
{
    public function actionIndex(){
        $resultOfCheck = User::checkUser();

        if(gettype($resultOfCheck) == 'array'){
            header('Location: user/cab');
        }else{
            require_once(ROOT.'/views/site/login.php');
        }
    }
}