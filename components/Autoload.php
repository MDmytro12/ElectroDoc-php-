<?php

function  autoloader($class_name){
    $pathS = array(
        '/components/',
        '/models/',
    );

    foreach ($pathS as $path){
        $path = ROOT.$path.$class_name.'.php';
        if(is_file($path)){
            include_once $path;
        }
    }
}
spl_autoload_register('autoloader');