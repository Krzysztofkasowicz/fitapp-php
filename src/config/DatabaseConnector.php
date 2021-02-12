<?php

class DatabaseConnector
{
    private $connection = null;

    /**
     * DatabaseConnector constructor.
     * @param null $connection
     */
    public function __construct()
    {
        $hostname = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $databaseName = $_ENV['DB_DATABASE'];
        $username = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];
        try {
            $this->connection = new PDO(
                "mysql:host=$hostname;port=$port;charset=utf8mb4;dbname=$databaseName",
                $username,
                $password
            );
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (PDOException $e){
            exit($e->getMessage());
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}