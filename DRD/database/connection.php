<?php

class db 
{
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $database = "drd";

    public $connection;
    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        $this->connection->set_charset("utf8");
    }
    
    private function getNextRow ($query_result)
    {
        $result = array();
        if (!is_object($query_result))
        {
            return null;
        }
        while ($row = $query_result->fetch_assoc()) 
        {
            array_push($result, $row);
        }
        return $result;
    }

    public function getRecordsPerPage ()
    {
        return 50;
    }

    public function executeQueryRaw ($sql_query)
    {
        $result = $this->connection->query($sql_query);
        $this->connection->set_charset("utf8");
        return ($result);
    }
    
    public function executeQuery ($sql_query)
    {
        
        $result = $this->connection->query($sql_query);
        $this->connection->set_charset("utf8");
        return $this->getNextRow($result);
    }
    
    public function getNumberOfPages ($table_name,$extra='')
    {
        $sql = "SELECT * FROM {$table_name} ".$extra;
        $result =  $this->connection->query($sql);
        $database_array = $this->getNextRow($result);
        $count = count($database_array);
        
        return ceil($count / $this->getRecordsPerPage());
    }

    public function searchTable ($table_name,$key,$column,$extra='')
    {
        $sql_qry = "SELECT * FROM {$table_name} WHERE {$column} LIKE '%{$key}%'".$extra;
        $result =  $this->connection->query($sql_qry);
        return $this->getNextRow($result);
    }
    
    public function readTable ($table_name,$extra='',$page = -1,$key = 'id',$order='DESC')
    {
        if ($page === -1)
        {
            $sql_query = "SELECT * FROM {$table_name} ".$extra;
        }
        else
        {
            $record_per_page = $this->getRecordsPerPage();
            $start_from = ($page - 1) * $record_per_page;

            $sql_query = "SELECT * FROM {$table_name} ".$extra." ORDER BY {$key} {$order} LIMIT $start_from, $record_per_page ";
        }
        
        
        
        $this->connection->set_charset("utf8");
        $result =  $this->connection->query($sql_query);
        return $this->getNextRow($result);
    }
    
    public function addToTable($table_name,$array_of_data)
    {
        
        $sql_query = "INSERT INTO {$table_name} (";
        $tmp = '';
        
        $i = 1;
        
        foreach ($array_of_data as $key => $value) {
            $sql_query .= $key;
            $tmp .= "'". $value."'";
            if ($i <= count($array_of_data) -1 )
            {
                $sql_query.=',';
                $tmp .= ',';
            }
            
            $i++;
        }
        
        $sql_query .= ') VALUES (';
        $sql_query .= $tmp;
        $sql_query .= ")";
                
        $this->connection->set_charset("utf8");
        $this->connection->query($sql_query);
        
    }
    
    public function getInsertedId ()
    {
        return $this->connection->insert_id;
    }
    
    public function editTable($table_name,$array_of_data,$key,$value)
    {
        $sql_query = "UPDATE {$table_name} SET ";
        
        $tmp = ' WHERE '.$key."='".$value."'";
        
        $i=1;
        foreach ($array_of_data as $column => $val) {
            $sql_query .= $column."='".$val."'";
            if ($i <= count($array_of_data) -1 )
            {
                $sql_query.=' , ';
            }
            
            $i++;
        }
        
        $sql_query .= $tmp;

        $this->connection->query($sql_query);
        
    }
    
    public function deleteFromTable($table_name,$key,$value)
    {
        $sql_query = "DELETE FROM {$table_name} WHERE {$key} = '{$value}'";
        $this->connection->query($sql_query);  
    }
    
}

class tables
{
    public static $answers_name = 'answers';
    public static $answers = array(
        'ans_id'=>'',
        'ques_id'=>'',
        'answer'=>'',
        'score'=>''
    );
    
    
}



$GLOBALS['db'] = new db();
date_default_timezone_set('Africa/Cairo');