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
            $users = $this->model;
            /*
            $users->Insert([
                "name" => "abanob",
                "mail" => "abanob@gmail.com",
                "password" => "1234"
            ]);
            */
            /*
            $users->Update(11, [
                "name" => "bebooo",
                "mail" => "bebooo@gmai.com"
            ]);
            */
            //$users->Delete("w5555");
           // echo $users->size();
          // var_dump($users->GetAll());
         // var_dump($users->GetOne(11));
          $arr = $users->GetWhere("name = ?", ["abanob"], [
             "LIMIT" => 10,
             "ORDER BY" => ["password", "DESC"]
         ]) ;

         foreach($arr as $row)
         {
             foreach($row as $key => $val)
             {
                 echo $key . " " . $val . ", " ; 
             }
             echo END;
         }
         $this->view("LogIn");
        }
    }
echo "log log " ;
$CCC = new LOGInController();

?>