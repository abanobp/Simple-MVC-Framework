<?php

class LogInController extends controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->LoadModel("users");
        }
        public function index($args)
        {
            $this->view("<H1>Welcome in my logIn Page :D</H1>");
        }
    }
?>