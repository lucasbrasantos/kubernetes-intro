<?php

$servername = "mysql-service";
$username = "root";
$password = "root";
$dbname = "k8s-db-example";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
	// Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>