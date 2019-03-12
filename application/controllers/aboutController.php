<?php
class aboutController extends controller
{
    function __construct()
    {
       parent::__construct();
    }
    
    public function index($args = array())
    {
 
     //   echo "<pre>" . var_export($_GET, true) . "</pre>";
       // $this->ConvertToArrayNames($args);

        $this->view("about" , ["name" => 'abanob']);
    }
}
?>