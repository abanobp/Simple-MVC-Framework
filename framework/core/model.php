<?php
class model 
{
    protected $MyDB ;
    protected $dbname ;
    protected $ColumnNames ; 
    protected $TableName ;
    protected $PrimaryKey;

    public function __construct($name)
    {
         $this->MyDB = new Database($GLOBALS['config']) ; 
         $this->dbname = $GLOBALS['config']['dbname'] ;
         $this->TableName = $name;
         $this->Get_Columns_Names();
    }

    private function Get_Columns_Names()
    {
        $stat = "SELECT * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME ='{$this->TableName}' AND TABLE_SCHEMA = '{$this->dbname}'";
        $result = $this->MyDB->query($stat) ;
        foreach($result as $row)
        {
            $ColumnNames [] = $row['COLUMN_NAME'] ;
            if ($row['COLUMN_KEY'] == 'PRI')
                $this->PrimaryKey = $row['COLUMN_NAME'] ;
        }
    }

    public function Insert($FildsValue = array())
    {   
        $MarksVals = array () ; 
        $FildsValue [$this->PrimaryKey] = $this->MyDB->Get_ID();
        $vals = ") VALUES (". str_repeat("?,", count($FildsValue));
        $vals[strlen($vals)-1] = ')'; 
        $flag = 0 ; 
        $stat = "INSERT INTO {$this->TableName} (" ; 

        foreach($FildsValue as $key => $val)
        {
           if ($flag)
             $stat .= ", ";
           $flag = 1;
           $stat .= $key ; 
           $MarksVals[] = $val ;
        }
        $stat .= $vals ; 
        $stat = rtrim($stat , ',') ; 
       
       $this->MyDB->exe($stat , $MarksVals); 
    }

    public function Update($ID , $FildsValue = array())
    {
        $Marks = "" ; 
        $MarksVals = array () ; 
        foreach($FildsValue as $key => $val)
        {
           $Marks .= "{$key} = ? ," ; 
           $MarksVals[] = $val ;
        }
        $Marks = rtrim($Marks , ',') ; 
        $stat = "UPDATE `{$this->TableName}` SET {$Marks} WHERE {$this->PrimaryKey} = $ID" ; 
        $this->MyDB->exe($stat , $MarksVals); 
    }
    public function Delete($ID)
    {
        $in = "" ;
        if (is_array($ID))
            $in = 'IN ('. str_repeat("?," , count($ID)) .')';
        else{
            $in = " = ?";
            $ID = array($ID);
        }
           
        $stat = "DELETE FROM `{$this->TableName}` WHERE {$this->PrimaryKey} {$in}" ; 
        $this->MyDB->exe($stat , $ID); 
    }
    public function Size()
    {
        $stat = "SELECT  *  FROM `{$this->TableName}`" ; 
        $res = $this->MyDB->query($stat);
        return $res->rowCount();
    }
    public function GetAll()
    {
        return $this->GetWhere();
    }
    public function GetOne($ID)
    {
        $res = $this->GetWhere("{$this->PrimaryKey}  = ?" , [$ID]);
        return $res[0] ; 
    }
    public function GetWhere($condition = "", $MarksVals = array(), $keys = array())
    {
        $stat = "SELECT  *  FROM `{$this->TableName}`" ; 
        if (!empty($condition))
            $stat .= ' WHERE ' . $condition;

        if (isset($keys["ORDER BY"]))
        {
            if (count($keys["ORDER BY"]) == 2)
            {
                 $stat .= "ORDER BY " . $keys["ORDER BY"][0] . " " . $keys["ORDER BY"][1];
            }
        }

        if (isset($keys["LIMIT"]) && $keys["LIMIT"] > 0)
        {
            $stat .= " LIMIT {$keys['LIMIT']}" ; 
        }
      
        $res = $this->MyDB->exe($stat,$MarksVals,1);
        return $res->fetchAll();
    }
}
?>