<?php

namespace SignupFormTest\Framework\DatabaseConnection;

use SignupFormTest\Framework\DatabaseConnection\Database;

class DatabaseConnection
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function connect($params)
    {
        return $this->database->connect($params);
    }
}
