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
   function startSection($SecName , $SecCont = NULL)
   {
     $this->SectionNow = $SecName ; 
     ob_start();
     if ( $SecCont != NULL)
     {
         echo $SecCont ;
         $this->stopSection() ; 
     }
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
   }

   function showSection()
   {
       $cont = ob_get_contents() ; 
       ob_end_clean();
       $rep =  $this->Sections[$this->SectionNow] ; 
       $rep = str_replace("@parent@" , $cont, $rep);
       echo $rep ; 
   }
}

?>