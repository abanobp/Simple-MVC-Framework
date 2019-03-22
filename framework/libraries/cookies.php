<?php
class Cookies
{
    public static function set($name , $value , $expirty= 3600, $domain = '/')
    {
        setcookie($name , $value ,time() + $expirty , $domain  );
    }

    public static function get($name)
    {
        if (self::isset($name))
            return $_COOKIE[$name] ; 
        else 
            return NULL ; 
    }
    public static function check($name)
    {
        return isset($_COOKIE[$name]) ; 
    }

    public  static function delete($name)
    {
        setcookie($name , "" ,time() - 3600);
    }

    public static function editValue($name , $NewVal)
    {
        if (self::check($name))
            $_COOKIE[$name] = $NewVal ; 
    }

    public static function editExpirty($name , $NewEX)
    {
        $value = self::get($name) ; 
        setcookie($name , $value , time() + $NewEX ) ; 
    }
}
?>