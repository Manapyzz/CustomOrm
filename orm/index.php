<?php

require_once ('autoload.php');

$database = new databaseManager\DbTable();

$result = $database->selectTable('movie')
                    ->findBy([
                        'title' => 'The Martian'
                    ]);

var_dump($result);



