<?php
class view 
{
   private $SectionNow = "" ;
   private $DefaultLayout = "" ; 
   public $Sections = array();
   function render($name,$arr = array())
   {
       //var_dump($arr);
        if (file_exists(VIEW_PATH . $name . "/index.php"))
        {
             require VIEW_PATH . $name . "/index.php";
             if (file_exists(LAYOUTS_PATH. $this->DefaultLayout . ".php"))
                 require LAYOUTS_PATH. $this->DefaultLayout . ".php";
        }
        else 
        {
            echo $name; 
            return ;
        }
   }
   function startSection($SecName)
   {
     $this->SectionNow = $SecName ; 
     ob_start(); 
   }
   function stopSection()
   {
       $this->Sections[$this->SectionNow] = ob_get_contents() ; 
       ob_end_clean();
       //var_dump($this->Sections);
   }

   function extend($layName)
   {
        $this->DefaultLayout = $layName ; 
   }

   function getHere($SecName)
   {
       if (isset($this->Sections[$SecName]))
            echo $this->Sections[$SecName] ;
       else 
        echo "Non-Valid Name";
   }
}

?>