<?php

require_once ('autoload.php');

$database = new databaseManager\DbTable();

$result = $database->selectTable('movie')
                    ->findById(23);

var_dump($result);



