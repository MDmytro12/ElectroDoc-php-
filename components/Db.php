<?php
class Db{
    public static function getConnection(){
        $parameters = include_once(ROOT.'/config/db_param.php');

        $dsn = "mysql: host={$parameters['host']} ; dbname={$parameters['dbname']}";
        $db = new PDO($dsn , $parameters['user'] , $parameters['password']);
        $db -> exec('set name utf-8');

        return $db;
    }
}