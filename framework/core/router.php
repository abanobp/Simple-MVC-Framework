<?php

class router
{
    private static $Paths = array();

    public static function run($url)
    {
        self::Autoload();
        $url = str_replace(domain , "", $url);
       // echo $url ; 
        if (array_key_exists($url,self::$Paths))
        {   
            $con = self::$Paths[$url][0]; 
            $controller = new $con (); 
            $fun = (isset($Paths[$url][1]))?$Paths[$url][1]:"index" ; 
            $controller->{$fun}();
        }
        else 
        {
            self::Routing($url);
        }
       

    }

    public static function setPath($url , $controller , $function = "index")
    {
        self::$Paths [$url] = array($controller,$function); 
    }
    
    private static function Autoload()
    {
        spl_autoload_register(array(__CLASS__,'load'));
    }

    private static function load($ClassName)
    {

        if (substr($ClassName , -10) == "Controller")
        {
            $class =  CONTROLLER_PATH . $ClassName . ".php" ;
        }
        else if (substr($ClassName , -5) == "Model")
        {
            $class = MODEL_PATH . $ClassName . ".php" ;
        }
      
        if (file_exists($class))
        {
            require_once $class;
        }
        else {
            require_once  CONTROLLER_PATH . "ErrorController.php" ;
            throw new Exception("Class Not Found"); 
        }
    }

    private static function Routing($url)
    {
        $url = rtrim($url,'/') ;
        $url = explode( '/', $url); 
        $controller = empty($url[1])? "home" : $url[1] ;
        $controller =   $controller . "Controller";
        try
        {
            $MyCon = new $controller () ; 
            if (count($url) >= 3 && method_exists($MyCon , $url[2]))
            {
                $fun = $url[2] ; 
                array_splice($url,0,3);
                $MyCon->{$fun}($url) ; 
            }
            else
            {
                array_splice($url,0,2);
                $MyCon->index($url) ;
            }
        }
        catch(Exception $e)
        {
            if ($e->getMessage() == "Class Not Found")
            {
                $MyCon = new ErrorController();
                $MyCon->index();
            }
            else 
                echo $e->getMessage();
        }
    }
}

?>