<?php

require 'db_config.php';

$conn = new PDO("mysql:host=" . $host . ";dbname=" . $db, $user, $pass);

$sql = "SELECT * FROM events ORDER BY days ASC";

//$events = $conn->query($sql);
$query = $conn->prepare($sql);
$query->execute();

$events = $query->fetchAll();

/*
foreach ($events as $event):
	var_dump($event);
	echo "</br>";
endforeach;
die;
*/