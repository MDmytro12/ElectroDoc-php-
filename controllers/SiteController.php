<?php

class SiteController
{
    public function actionIndex(){
        //$resultOfCheck = User::checkUser();
        $d1 = new mysqli('localhost','root','','electrodoc');
        
        $id = $d1->real_escape_string(1);
        
        $resultOfSelect = $d1->query("select * from user_info ;");
        
        $data = $resultOfSelect->fetch_assoc();
        
        
        echo 'Result of conection! :   ';
        print_r($data);
        echo '<br>';
         $d2 = new mysqli('localhost','root','','electrodoc');
        
        $id = $d2->real_escape_string(1);
        
        $resultOfSelect = $d2->query("select * from user_info ;");
        
        $data = $resultOfSelect->fetch_assoc();
        
        
        echo 'Result of conection! :   ';
        print_r($data);

        
    }
}