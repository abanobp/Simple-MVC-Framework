<?php 

require  "../framework/core/framework.php" ;
 //echo "<pre>" . var_export($_SERVER, true) . "</pre>";
//echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
//echo "<pre>" . var_export($_REQUEST, true) . "</pre>";
FrameWork::Run(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

?>