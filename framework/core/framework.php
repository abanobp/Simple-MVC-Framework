<?php
class FrameWork
{
    public static function Run($url)
    {
        self::Init();
        router::run($url);
    }

    private static function Init()
    {
        require_once "../application/config/init.php";
        require_once CORE_PATH . "controller.php";
        require_once CORE_PATH . "view.php";
        require_once CORE_PATH . "model.php";
        require_once CORE_PATH . "router.php";
        require_once DB_PATH . "database.php";
        require_once LIB_PATH . "session.php";

        $GLOBALS["config"] = require_once  CONFIG_PATH . "config.php";
        session::init();
        require_once  CONFIG_PATH . "routes.php" ; 
    }
}
?>