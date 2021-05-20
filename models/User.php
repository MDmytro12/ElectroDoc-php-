<?php

class User{
    #check registration of user
    public static function checkUser(){
        if(isset($_POST['submit'])){

            $login = $_POST['login'];
            $password = $_POST['password'];

            if( strlen($login) != 0 or strlen($password) != 0 ){
                if(!User::checkName($login) or !User::checkPassword($password)){
                    return 'error_input';
                }

                $db =Db::getConnection();
                
                $password = $db->real_escape_string(trim($password));
                $login = $db->real_escape_string(trim($login));
                $result = $db->query("select * from user_info where `login`='$login' and `password`='$password';");
                
                $result = $result->fetch_assoc();
                
                $db->close();
                
                if($result){
                    $_SESSION['id'] = $result['id'];

                    return array(
                        'id' => $result['id'],
                        'status' => $result['status'],
                    );
                }else{
                    return 'no_user';
                }
            }else{
                return 'empty_field';
            }
        }else{
            return false;
        }
    }
    #check the correct input of indetificator
    public static  function checkName($name){
        if(strlen($name) < 6 ){
            return false;
        }
        else{
            return true;
        }
    }
    #check the correct input of password
    public static function checkPassword($password){
        if(strlen($password) < 6){
            return false;
        }else{
            return true;
        }
    }
    #check the logging of user on site
    public static  function checkLogging(){
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
            return true;
        }
        return false;
    }
    #return status of user on site
    public static function getStatus(){
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
            $db = Db::getConnection();
            
            $id = $db->real_escape_string(trim($_SESSION['id']));
            $result = $db->query("select status from user_info where `id` = '$id'");
            
            $db->close();
            
            return $result->fetch_assoc()['status'];
        }
    }
    #return all information about user whithout password and login
    public static function getAllUserInfo(){
        $db = Db::getConnection();
        
        $id = $db->real_escape_string(trim($_SESSION['id']));
        
        $sql = "select * from users where `id` = '$id'";
        
        $result = $db->query($sql);
        
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }
    #return count of users with admin
    public static function getCountOfAllUsers(){
        $db = Db::getConnection();
        
        $sql = 'select COUNT(id) as count from user_info ';
        $reusult = $db->query($sql);
        
        $db->close();
        
        return $reusult->fetch_all(MYSQLI_ASSOC)[0]['count'];
    }
    #return masive of names of all users
    public static function getAllNamesUsers(){
        $db = Db::getConnection();
        
        $sql = 'select identef from users ;';
        
        $result = $db->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        
        $db->close();
        
        $newMasive = [];
        
        foreach($result as $item){
            array_push($newMasive , $item['identef']);
        }
        
        return $newMasive;
    }
    #return true if name in form is in masive
    public static function checkUserName($userName){
        $allNames = User::getAllNamesUsers();
        
        foreach($allNames as $item){
            if($item == $userName){
                return true;
            }
        }
        
        return false;
    }
}