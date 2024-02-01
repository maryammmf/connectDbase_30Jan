<?php

class MysqlDatabase implements DatabaseInterface
{

    private MySqlDatabaseConnection $connection ;
    private string $table;
    private string $query='';
    private PDOStatement $statment;


    public function __construct(MySqlDatabaseConnection $connection)
    {
        $this->connection = $connection;
    }


    public function getConnection() :MySqlDatabaseConnection
    {
        return $this->connection;
    }

    public function table(string $table) :self
    {
        $this->table = $table;
        return $this;
    }

    public function insert(array $column , array $values) :self
    {

        $pattern = "insert into %s (%s) values (%s)";
        $pattern = sprintf($pattern , $this->table , implode(',' , $column) , implode(',' , $values));
        $this->query = $pattern;
//        dd($this->query);
        return $this;
    }

    public function update(array $column , array $values)
    {
        //UPDATE `songs` SET `id`=121,`name`='11',`length`='11',`album_id`='8' WHERE id=15;
//        $pattern = "UPDATE %s SET `id`='[value-1]',`name`='[value-2]'";
        $firstpattern = "UPDATE %s SET";
        $st = [];
        for ($i=0 ; $i < count($column) ; $i++ ){
            $st[] = " $column[$i]=$values[$i]";
        }
        $newst= implode(' , ',$st);

        $pattern = $firstpattern .= $newst;



        $pattern = sprintf($pattern , $this->table);
//        dd($pattern);

        $this->query = $pattern;
//        dd($this->query);
        return $this;
    }

    public function select(array $column = ['*'])
    {
        $pattern = 'select %s from %s';
        $this->query = sprintf($pattern,implode(',' , $column) , $this->table);
        return $this;
    }

    public function delete()
    {
        $patern = 'delete from %s';
        $this->query = sprintf($patern , $this->table);
        return $this;
    }

    public function execute(): self
    {
        $this->statment = $this->connection->getPdo()->prepare($this->query);
//        dd($this->statment);
        $this->statment->execute();
         return $this;
    }

    public function fetchAll(): array
    {
        return $this->statment->fetchAll(PDO::FETCH_OBJ);
    }


    public function where(string $column, array $values, string $operation , string $logicOperation=null) :self
    {
        $firstPattern =  " where";
        $secoundPattern=[];
        foreach ($values as $value){
            $secoundPattern[] .=  " $column $operation $value";
        }
        $npattern = implode(' '.$logicOperation , $secoundPattern);
        $pattern = $firstPattern .= $npattern;
        $this->query .= $pattern;
//        dd($this->query);die();
        return $this;
    }


//    public function where(string $column, string $value, string $operation) :self
//    {
//        $pattern =  " where $column $operation $value";
//        $this->query .= $pattern;
////        dd($this->query);die();
//        return $this;
//    }
}