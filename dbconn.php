<?php
// Database configuration
$host = "localhost"; // Change this if your database is located on a different host
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "LibSys"; // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
