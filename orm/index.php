<?php

require_once ('autoload.php');

$database = new databaseManager\DbTable();

$array = [
    'name',
    'age'
];

$result = $database->selectTable('movie')
                    ->leftJoin('directors', 'id', 'movie_id', $array);

var_dump($result);



