<?php

class User{
    #check registration of user
    public static function checkUser(){

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

    }
}