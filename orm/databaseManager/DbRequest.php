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

    public function sortBy($sort, $param) {

        if($sort == "ASC") {
            $sql = "SELECT * FROM ".$this->table." WHERE 1 ORDER BY ".$param." ".$sort;
        }

        if($sort == "DESC") {
            $sql = "SELECT * FROM ".$this->table." WHERE 1 ORDER BY ".$param." ".$sort;
        }

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    public function leftJoin($second_table, $first_join_field, $second_join_field, $display_fields) {

        $fieldsToDisplay = "";

        for ($i = 0; $i < count($display_fields); $i++) {

            if($i != count($display_fields)-1) {
                $fieldsToDisplay .= $second_table.".".$display_fields[$i].", ";
            } else {
                $fieldsToDisplay .= $second_table.".".$display_fields[$i]." ";
            }
        }

        $sql = "SELECT *, ". $fieldsToDisplay ."FROM ".$this->table." LEFT JOIN ". $second_table . " ON " . $this->table.".".$first_join_field." = ". $second_table.".".$second_join_field. " WHERE 1";

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

}