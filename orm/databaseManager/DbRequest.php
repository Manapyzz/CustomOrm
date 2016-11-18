<?php

namespace databaseManager;

class DbRequest {

    protected $table;

    public function __construct($table_name)
    {
        $this->table = $table_name;
    }

    public function connection() {
        $database = new Database();

        $connection = $database->connect();

        return $connection;
    }

    public function findById($id) {
        $sql = "SELECT * FROM ".$this->table." WHERE id = ".$id;

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }

    public function findAll() {
        $sql = "SELECT * FROM ".$this->table." WHERE 1";

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    public function findBy($array) {
        $keys = array_keys($array);
        $whereStmt = "";

        for($i = 0; $i < count($array); $i++) {

            if($i == 0) {
                $whereStmt .= " WHERE ".$keys[0]." = '".$array[$keys[0]]."'";
            } else {
                $whereStmt .= " AND ".$keys[$i]." = '".$array[$keys[$i]]."'";
            }
        }

        $sql = "SELECT * FROM ".$this->table.$whereStmt;

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    // ORDER BY
    // LEFT JOIN

}