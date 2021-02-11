<?php

namespace Framework\Database;

class Database
{

    /** @var \PDO $database */
    private $database;

    public function __construct(array $config)
    {
        $this->database = new \PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
        $this->database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->database->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
    }

    public function getConnection(): \PDO
    {
        return $this->database;
    }

}