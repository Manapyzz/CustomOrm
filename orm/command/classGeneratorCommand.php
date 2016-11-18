<?php

namespace command;

require_once ('databaseManager/Database.php');

echo "Welcome to the class generator ! :) \n";
echo "Please right the name of the entity you want to generate from your database: ";
$handle = fopen ("php://stdin","r");
$table_name = preg_replace('/\s+/', '', fgets($handle));


$database = new \databaseManager\Database();
$connection = $database->connect();
$stmt = $connection->prepare('SHOW columns FROM '.$table_name);
$stmt->execute();

$results = $stmt->fetchAll();

if(empty($results)) {
    echo "Sorry, class not found in your database :( \n";
    exit;
}

$fileName = "entity/".ucfirst(strtolower($table_name)).".php";
$classFile = fopen($fileName, "w");

$classDefinition = "<?php \n\nnamespace entity; \n\nClass ".ucfirst(strtolower($table_name))." {\n\n\n\n}";
fwrite($classFile, $classDefinition);

$lines = file("entity/".ucfirst(strtolower($table_name)).".php");


foreach($results as $result) {
    $lines['5'] .= "\tprotected $".$result['Field'].";\n";
    $lines['6'] .= "\tpublic function get".ucfirst($result['Field'])."()\n\t{\n\t\t".'return $this->'.$result['Field'].";\n\t}\n\n";
    $lines['7'] .= "\tpublic function set".ucfirst($result['Field'])."($".$result['Field'].")\n\t{\n\t\t".'$this->'.$result['Field']." = $".$result['Field'].";\n\t}\n\n";
}

file_put_contents($fileName, $lines);

echo "Class Generated Correctly ! :)\n";