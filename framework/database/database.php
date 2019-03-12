<?php
class Database extends PDO 
{
    function __construct($config = array())
    {
        $host = isset( $config['host'])? $config['host']:"localhost";
        $user = isset( $config['user'])? $config['user']:"root";
        $pass = isset( $config['password'])? $config['password']:"";
        $dbname = isset( $config['dbname'])? $config['dbname']:"";
        $DNS = 'mysql:host='. $host . ';dbname=' .$dbname ; 

        try {
          parent::__construct($DNS , $user , $pass) ; 
          $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) ;
        } 
    
        catch (Exception $e) {
            echo 'EROR IN DATABASE CONNECTION<br>'; 
            echo $e->getMessage();
        }
    }

    function Get_ID($name ="")
    {
        if (empty($name)) $name = time() ; 
         return $name . uniqid("" , true); 
    }

    public function exe($stat , $MarksVals = array() , $ret = 0)
    {
        try
        {
            $st = $this->prepare($stat);
            if ($st->execute($MarksVals)) 
            {
                if ($ret)
                    return $st ; 
            }
            else 
            {
                echo "ERROR: DATABASE QUERY PROBLEM" ; 
            }
        }
        catch(Exception $e)
        {
            echo $e->get_message() ;
        }
    }
}
?>