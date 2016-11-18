<?php

require_once ('autoload.php');

$database = new databaseManager\DbTable();

$result = $database->selectTable('movie')
                    ->findAll();

var_dump($result);



