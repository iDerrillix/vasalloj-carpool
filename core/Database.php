<?php
class Database{

    public $connection;

    public function __construct($config)
    {
        $dsn = 'mysql:' . http_build_query($config['database'], '', ';');
        $this->connection = new PDO($dsn, 'root', '', [PDO:: ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function fetch($query, $params = []){
        $statement = $this->connection->prepare($query);
        if($statement->execute($params)){
            return $statement;
        }
        return false;
    }
    public function execQuery($query, $params = []){
        $statement = $this->connection->prepare($query);
        if($statement->execute($params)){
            return true;
        }
        return false;
    }
}
?>