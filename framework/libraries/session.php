<?php

class session 
{
    public static function init()
    {
        session_start();
    }
    public static function Set($key , $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function Get($key)
    {
        if (isset($_SESSION[$key]))
            return  $_SESSION[$key];
        else 
            return 0 ;
    }
    public static function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }
}

?>