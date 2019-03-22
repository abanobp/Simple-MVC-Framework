<?php
class Database extends PDO 
{
    private $host ;
    private $user; 
    private $pass;
    private $dbname;
    private static $DataBaseObj = NULL;
    private $tableName = "" ; 
    private $primarykey = "" ; 
    private function __construct($config = array())
    {
        $this->host = isset( $config['host'])? $config['host']:"localhost";
        $this->user = isset( $config['user'])? $config['user']:"root";
        $this->pass = isset( $config['password'])? $config['password']:"";
        $this->dbname = isset( $config['dbname'])? $config['dbname']:"";
        $DNS = 'mysql:host='. $this->host . ';dbname=' .$this->dbname ; 

        try {
          parent::__construct($DNS , $this->user , $this->pass) ; 
          $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) ;
        } 
    
        catch (Exception $e) {
            echo 'EROR IN DATABASE CONNECTION<br>'; 
            echo $e->getMessage();
        }
    }
    public static function getDataBaseObj($table = "", $config = array())
    {
        if (self::$DataBaseObj == NULL)
        {
            self::$DataBaseObj = new Database($config) ;
        }
        if (strlen($table))
             self::$DataBaseObj->setTableName($table); 
        return self::$DataBaseObj ; 
    }
    function getTableName()
    {
        return $this->tableName ; 
    }
    function setTableName($table)
    {
        if ($table == $this->tableName)
            return;
        $this->tableName = $table; 
        $this->primarykey = $this->getTableId();
    }
    function getTableId()
    {
        $stat = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
                 WHERE TABLE_NAME ='{$this->tableName}' AND TABLE_SCHEMA = '{$this->dbname}' AND COLUMN_KEY = 'PRI' ";
        $res = $this->query($stat) ;
        $res = $res->fetch() ; 
        return  $res ['COLUMN_NAME']  ;
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


    //##################################################################################
    //# insert function, you can call it throw this class object 
    //# the function parameter  is an array and each element key is the inserted fild 
    //# and each key's value is its value 
    //# ex: insert(["name" => "Abanob Ashraf", "Mail" => "ab.ashraf19@gmail.com"]) 
    //##################################################################################
    public function insert(array $FildsValue = array())
    {   
        $MarksVals = array () ; // this array created to collect the filds values to put it to execute function of the PDO 
        $FildsValue [$this->primarykey] = uniqid("" , true); // pushing the id of the recored in the filds array
        $vals = ") VALUES (". str_repeat("?,", count($FildsValue)); // generat the ? of the query statment to prepare the query using PDO
        $vals[strlen($vals)-1] = ')'; 
        $flag = 0 ;
        $stat = "INSERT INTO {$this->tableName} (" ; 

        // this loop to iterate the filds array 
        foreach($FildsValue as $key => $val)
        {
           if ($flag)
             $stat .= ", "; // to adding comma after each fild name
           $flag = 1;
           $stat .= $key ; // appendding the fild name to the statment 
           $MarksVals[] = $val ; // appendding the fild values
        }
        $stat .= $vals ; 
        $stat = rtrim($stat , ',') ; 
       
       $this->exe($stat , $MarksVals); // giving the exe function the query and its marks values 
    }


    //##################################################################################
    //# update function, you can call it throw this class object 
    //# the function parameters is a string variable contains a where condetion of the update query 
    //# the second parameter is an array and each element key is the inserted fild 
    //# and each key's value is its value 
    //# ex: update ("id = 5" ,["name" => "Abanob Ashraf", "Mail" => "ab.ashraf19@gmail.com"] )
    //##################################################################################
    public function Update($where = "" , array $FildsValue = array())
    {
        $Marks = "" ; 
        $MarksVals = array () ; // this array created to collect the filds values to put it to execute function of the PDO 
        // this loop to iterate the filds array 
        foreach($FildsValue as $key => $val)
        {
           $Marks .= "{$key} = ? ," ; // the formation of the update query 
           $MarksVals[] = $val ;
        }
        $Marks = rtrim($Marks , ',') ; 
        $stat = "UPDATE `{$this->tableName}` SET {$Marks}"; // the basic query without any condition 
        if ($where != "")
        $stat .= " WHERE " . $where ; // append the condetion if the where variable = true 
        $this->exe($stat , $MarksVals); // giving the exe function the query and its marks values 
    }

    //##################################################################################
    //# Delete function, you can call it throw this class object 
    //# the function  parameter is an array and each element is an ID value you want to delete its recored
    //# ex: Delete ([10,50])
    //##################################################################################
    public function Delete(array $ID)
    {
        if (!count($ID))
            return 0 ;
        $in = 'IN ('. str_repeat("?," , count($ID)-1) .'? )'; // the formation of IN condetion and append all IDs marks 
        $stat = "DELETE FROM `{$this->tableName}` WHERE {$this->primarykey} {$in}" ; // the final query of the update
        $this->exe($stat , $ID); // giving the exe function the query and its marks values 
    }


    //##################################################################################
    //# Size function, you can use it to get the table row count
    //##################################################################################
    public function size()
    {
        $stat = "SELECT  *  FROM `{$this->tableName}`" ; 
        $res = $this->query($stat);
        return $res->rowCount();
    }
     //##################################################################################
    //# GetAll function, you can use it to get all table's recordes
    //##################################################################################
    public function getAll()
    {
        return $this->getWhere();
    }


    //##################################################################################
    //# getOne function, you can use it to get one table record by its ID
    //# the function takes one parameter, it the ID of the record
    //##################################################################################
    public function getOne($ID)
    {
        $res = $this->getWhere("{$this->primarykey}  = ?" , [$ID]);
        return $res[0] ; 
    }

    //##################################################################################
    //# getWhere function, you can use it to get one table record by in some conditions and limit and order by key
    //# the function takes three parameters,
    //# the first parameter is the where condition written by the ? mark without having any value
    //# the second parameter is an array of the this marks values of the condition  
    //# the third condition is an array having some keys and this keys are 
    //# the "LIMIT"  key and its value is an integer number > 0
    //# the "ORDER BY" key and its values is an array the first element is the column name and the second is the sort type "ASC| DESC"
    //##################################################################################
    public function getWhere($condition = "", array $MarksVals = array(), array $keys = array())
    {
        $stat = "SELECT  *  FROM `{$this->tableName}`" ; // the basic query without any condition or limits
        if (!empty($condition))
            $stat .= ' WHERE ' . $condition; // append the where condition

        if (isset($keys["ORDER BY"])) // check if we have an ORDER BY key or not to append it
        {
             // ORDER BY should have two elements,
            // the first is the column name and the second is  the type of the sort "ASC| DESC"
            if (count($keys["ORDER BY"]) == 2) 
            {
                 $stat .= "ORDER BY " . $keys["ORDER BY"][0] . " " . $keys["ORDER BY"][1];
            }
        }

        if (isset($keys["LIMIT"]) && $keys["LIMIT"] > 0) // check if we have a LIMIT key or not to append it
        {
            $stat .= " LIMIT {$keys['LIMIT']}" ; 
        }
      
        $res = $this->exe($stat,$MarksVals,1);
        return $res->fetchAll(); // return the full array of record data
    }
}
?>