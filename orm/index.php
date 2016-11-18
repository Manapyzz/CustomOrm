<?php

require_once ('autoload.php');

$database = new databaseManager\DbTable();


$fields = [
    'title' => 'Scream 2',
    'income' => '100000000',
    'category' => 'Horror'
];

$whereStmts = [
    'title' => 'Scream 2',
    'category' => 'Horror'
];

$result = $database->selectTable('movie')
                    ->delete($whereStmts);

var_dump($result);



