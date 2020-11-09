<?php

class DbOperations
{
    private $pdo_connection;
    private static $connected_tables;

    public function __construct(string $db_name = "main")
    {
        $this -> pdo_connection = new PDO("sqlite:".$dbname);
    }

    public function connectTable(string $table_name)
    {
        try {
            $statement = "SELECT TOP 1 FROM ".$table_name;
        } 
        catch (PDOException $e) {
            if($e -> getMessage() == "Base table or view not found")
            {
                $statement = "CREATE TABLE ".$table_name
            }
        }
        $self -> pdo_connection -> query
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
}