<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "test";

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
    echo "Connection failed";
}

// Define the upload directory
define('UPLOAD_PATH', 'F:/Coding 3/wst-php/uploads/');

?>