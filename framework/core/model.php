<?php
class model 
{
    protected $MyDB ;
    protected $dbname ;
    protected $ColumnNames ; 
    protected $tableName ;
    protected $primaryKey;

    public function __construct($name)
    {
         $this->MyDB = Database::getDataBaseObj($name,$GLOBALS['config']) ; 
         $this->tableName = $name;
         $this->Get_Columns_Names();
    }

    private function Get_Columns_Names()
    {
        $stat = "SELECT * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME ='{$this->tableName}' AND TABLE_SCHEMA = '{$this->dbname}'";
        $result = $this->MyDB->query($stat) ;
        foreach($result as $row)
        {
            $ColumnNames [] = $row['COLUMN_NAME'] ;
            if ($row['COLUMN_KEY'] == 'PRI')
                $this->PrimaryKey = $row['COLUMN_NAME'] ;
        }
    }
    public function insert(array $FildsValue = array())
    {
        $this->MyDB->setTableName($this->tableName); 
        $this->MyDB->insert($FildsValue) ; 
    }
    public function Update($where = "" , array $FildsValue = array())
    {
        $this->MyDB->setTableName($this->tableName); 
        $this->MyDB->update($where, $FildsValue) ; 
    }
    public function Delete(array $ID)
    {
        $this->MyDB->setTableName($this->tableName); 
        $this->MyDB->Delete($ID) ; 
    }
    public function size()
    {
        $this->MyDB->setTableName($this->tableName); 
        return $this->MyDB->size() ; 
    }
    public function getAll()
    {
        $this->MyDB->setTableName($this->tableName); 
        return $this->MyDB->getAll() ; 
    }
    public function getOne($ID)
    {
        $this->MyDB->setTableName($this->tableName); 
        return $this->MyDB->getOne($ID); 
    }
    public function getWhere($condition = "", array $MarksVals = array(), array $keys = array())
    {
        $this->MyDB->setTableName($this->tableName); 
        return $this->MyDB->getWhere($condition,$MarksVals, $keys);
    }
}
?>