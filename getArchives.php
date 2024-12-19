<?php
// Once called by js, this script will return all the archived books in the database

// Include the database configuration file
include 'dbconfig.php';

// Prepare a select statement
$sql = "SELECT * FROM books WHERE isArchived = 1";

// Execute the statement
$result = $conn->query($sql);

// Check if the result is not empty
if($result->num_rows > 0) {
    // Fetch the result as an associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Return the result as a JSON object
    echo json_encode($rows);
} else {
    // Return an error message
    echo "No books found";
}

// Close the database connection
$conn->close();
?>