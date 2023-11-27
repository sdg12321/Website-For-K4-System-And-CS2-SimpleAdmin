<?php
// Fill in the login information
$hostname = ""; // database server address
$username = ""; // username
$password = ""; // password
$database = ""; // database name

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexiunea la baza de date a eșuat: " . $e->getMessage());
}
?>

