<?php

class helpController extends controller
{
    function __construct()
    {
       parent::__construct();
    }
    public function index($args = array())
    {
        $this->view("help");
    }
}
?>