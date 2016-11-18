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

    //CRUD

    public function create($entity) {

        $keys = array_keys($entity);
        $columns = "";
        $allValues = "";

        for($i = 0; $i < count($keys); $i++) {

            if($i != count($keys)-1) {
                $columns .= "".$keys[$i].",";
                $allValues .= "'".$entity[$keys[$i]]."',";
            } else {
                $columns .= "".$keys[$i]."";
                $allValues .= "'".$entity[$keys[$i]]."'";
            }
        }

        $sql = "INSERT INTO " . $this->table. " (" .$columns.") VALUES (". $allValues.")";

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        return "New Entry for table" .$this->table. " Created";
    }

    public function update($fieldsToChange, $whereStmts) {

        $keys = array_keys($whereStmts);
        $fields_keys = array_keys($fieldsToChange);

        $whereString = "";
        $fieldsStmt = "";

        for($i = 0; $i < count($keys); $i++) {

            if($i != 0) {
                $whereString .= " AND ".$keys[$i]."='".$whereStmts[$keys[$i]]."'";
            } else {
                $whereString .= $keys[$i]."='".$whereStmts[$keys[$i]]."'";
            }
        }

        for($i = 0; $i < count($fields_keys); $i++) {
            if($i != count($fields_keys)-1) {
                $fieldsStmt .= $fields_keys[$i]."='".$fieldsToChange[$fields_keys[$i]]."',";
            } else {
                $fieldsStmt .= $fields_keys[$i]."='".$fieldsToChange[$fields_keys[$i]]."'";
            }
        }

        $sql = "UPDATE ".$this->table." SET ". $fieldsStmt . " WHERE ".$whereString;

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        return "One Entry Updated in table " .$this->table;
    }

    public function delete($whereStmts) {

        $keys = array_keys($whereStmts);
        $whereString = "";

        for($i = 0; $i < count($keys); $i++) {

            if($i != 0) {
                $whereString .= " AND ".$keys[$i]."='".$whereStmts[$keys[$i]]."'";
            } else {
                $whereString .= $keys[$i]."='".$whereStmts[$keys[$i]]."'";
            }
        }

        $sql = "DELETE FROM ".$this->table." WHERE ".$whereString;

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        return "One Entry Deleted in table " .$this->table;
    }

    public function countAll() {

        $sql = "SELECT COUNT(*) FROM ".$this->table;

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }

    public function isExist($whereStmts) {

        $keys = array_keys($whereStmts);
        $whereString = "";

        for($i = 0; $i < count($keys); $i++) {

            if($i != 0) {
                $whereString .= " AND ".$keys[$i]."='".$whereStmts[$keys[$i]]."'";
            } else {
                $whereString .= $keys[$i]."='".$whereStmts[$keys[$i]]."'";
            }
        }

        $sql = "SELECT EXISTS (SELECT * FROM ".$this->table." WHERE ". $whereString;

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }
}