<?php
// Fill in the login information
$hostname = "localhost"; // database server address
$username = "root"; // username
$password = "password"; // password
$database = "database"; // database name

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

