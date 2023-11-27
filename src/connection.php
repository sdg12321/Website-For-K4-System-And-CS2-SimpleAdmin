<?php
// Fill in the login information
$hostname = ""; // database server address

$username = ""; // username

$password = ""; // password

$database = ""; // database name

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set the charset for the database connection
//$conn->set_charset("utf8mb4");
?>
