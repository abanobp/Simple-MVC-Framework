<?php
require_once "../../framework/database/database.php";
$o =  Database::getDataBaseObj("users" , include "config.php") ;

 //$o->insert( ["name" => "Abanob Ashraf Kamal" , "password" => "abcde" , "mail" => "abb@gmail.com" ]) ;

 //$o->update("id IN (10,11)" ,["name" => "Abanob Ashraf", "mail" => "ab.ashraf19@gmail.com"] );
 //$o->delete([0,11]);

 //echo $o->Size();
 //$o->insert( ["name" => "Abanob Ashraf Kamal" , "password" => "abcde" , "mail" => "abb@gmail.com" ]) ;
 //echo $o->Size();
/*
 echo "<pre>" . var_export($o->getWhere("name = ?" , ["abanob"] , [
     "LIMIT" => 2,
     "ORDER BY" => ["password" , "DESC"]
 ] ), true) . "</pre>";
 */
?>
