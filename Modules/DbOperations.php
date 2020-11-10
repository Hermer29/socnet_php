<?php
class PREFAB
{
    public const AUTHENTICATION = "AUTHENTICATION";
    public const SIMPLE_TEXT = "SIMPLE_TEXT";
}

class DbOperations
{
    private $pdo_connection;
    private static $connected_tables = [];

    public function __construct(string $db_name = "main")
    {
        self::$pdo_connection = new PDO("sqlite:".$dbname);
    }

    public function connectTable(string $table_name = "main", ?string $creation_pattern) : Table
    {
        try 
        {
            $statement = "SELECT TOP 1 FROM ".$table_name;
            self::$pdo_connection -> query($statement) -> fetch();
        } 
        catch (PDOException $e) 
        {
            if($e -> getMessage() == "Base table or view not found" || !$creation_pattern == null)
            {
                $statement = "CREATE TABLE ". $table_name .getFieldList($creation_pattern);
                self::$pdo_connection -> query($statement) -> execute();
            }
            else if($creation_pattern == null)
            {
                throw new Exception("If table doesn't exist creation pattern must be given in method");
            }
            else
            {
                throw $e;
            }
        }
        $statement = "select * from pragma_table_info('$table_name')";
        $column_list = self::$pdo_connection -> query($statement) -> fetchAll(PDO::FETCH_ASSOC);
        for($i = 0; i < count($column_list); $i++)
        {
            array_push($res_column_list, $column_list[i]);
        }

        array_push(self::$connected_table, new Table($table_name, $res_column_list));
    }

    public function getData(string $table, array $fields) : array
    {
        
        $elem = array_search($table,self::$connected_tables, $strict = true);
        if(elem instanceof Table)
        {
            for($i = 0; i < count($fields); $i++, $field = array_pop($fields))
            {
                $field = array_search($field, $elem -> getFields(), $strict = true);
                if($field != false)
                {
                    $statement = "SELECT $field FROM ". $elem -> getName();
                }
                else
                {
                    $reasulting_array[] = "Didn't find field ".$elem;
                    continue;
                }
            }
        }  
    }

    private function createFieldList(string $creation_pattern) : string
    {
        switch ($creation_pattern)
        {
            case "AUTHENTICATION":
                $field_list = "(id INTEGER PRIMARY KEY AUTOINCREMENT, username VARCHAR(30), password TEXT)";
                break;
            case "SIMPLE_TEXT":
                $field_list = "(id INTEGER PRIMARY KEY AUTOINCREMENT, info TEXT)";
                break;
            default:
                throw new Exception("Incorrect given string in getFieldList");
        }
        return $field_list;
    }
}

class Table
{
    private $table_name;
    private $fields; 
    public function __construct(string $table_name, array $fields)
    {
        $this -> table_name = $table_name;
        $this -> fields = $fields; 
    }
    public function getName() : string
    {
        return $this -> table_name;
    }
    public function getFields() : array
    {
        return $this -> fields;
    }    
}