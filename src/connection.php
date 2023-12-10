<?php
// Fill in the login information
$hostname = ""; // database server address
$port = "3306"; // specify the database server port (change it to your port)
$username = ""; // username
$password = ""; // password
$database = ""; // database name

try {
    // Add the port to the connection string
    $conn = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
