<?php

namespace databaseManager;

class Database {

    #This is an example but make sure to put your database credentials.

    protected $db_host = '127.0.0.1';
    protected $db_name = 'customormdb';
    protected $db_user = 'root';
    protected $db_pass = 'root';

    // Open a connect to the database.
    // Make sure this is called on every page that needs to use the database.

    public function connect()
    {
        $connection = new \PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.'', $this->db_user, $this->db_pass);

        return $connection;
    }
}