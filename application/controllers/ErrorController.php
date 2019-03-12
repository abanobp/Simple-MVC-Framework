<?php
class ErrorController extends controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view("Error");
    }
}
?>