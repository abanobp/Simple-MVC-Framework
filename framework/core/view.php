<?php
class view 
{
   function render($name,$arr = array())
   {
       //var_dump($arr);
        if (file_exists(VIEW_PATH . $name . "/index.php"))
        {
             require VIEW_PATH . $name . "/index.php";
        }
        else 
        {
            echo $name; 
            return ;
        }
   }
}

?>