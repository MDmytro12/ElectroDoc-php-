<?php
include_once(ROOT.'/controllers/SiteController.php');

class Router{
    public $routes;
    # constructer of class Router
    public function __construct()
    {
        $this->routes = include_once(ROOT.'/config/routes.php');
    }
    #method return url of request
    private function getURL(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI']);
        }
    }
    #method choose kind of controller and model
    public function run(){
        $url = $this->getURL();

        foreach ($this->routes as $uri_pattern => $path){

            if(preg_match("~$uri_pattern~",$url)){

                $internalRouter = preg_replace("~$uri_pattern~",$path , $url);


                $segments = explode('/',$internalRouter);
                if($segments[0]==''){
                    array_shift($segments);
                }

                $controllName =  ucfirst(array_shift($segments).'Controller');
                $controllAction = 'action'.ucfirst(array_shift($segments));

                $file = ROOT.'/controllers/'.$controllName.'.php';
                $parametrs = $segments;

                if(is_file($file)){
                    include_once($file);
                }

                $controllerObject  = new $controllName;
                call_user_func_array(array($controllerObject ,$controllAction) , $parametrs);
                break;
            }
        }

    }
}