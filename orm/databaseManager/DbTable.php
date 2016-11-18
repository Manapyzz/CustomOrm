<?php

namespace databaseManager;

class DbTable {

    public function selectTable($table_name) {

        $request = new DbRequest($table_name);

        return $request;
    }
}