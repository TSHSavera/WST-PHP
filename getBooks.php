<?php
// Once called by js, this script will return all the books in the database

// Include the database configuration file
include 'dbconfig.php';

// Check for parameter
if(isset($_GET['id'])) {
    // Get the id parameter
    $id = $_GET['id'];

    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE id = $id AND isArchived = 0";

    // Execute the statement
    $result = $conn->query($sql);

    // Check if the result is not empty
    if($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Return the result as a JSON object
        echo json_encode($row);
    } else {
        // Return an error message
        echo "Book not found";
    }
} else {
    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE isArchived = 0";

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
}

// Close the database connection
$conn->close();
?>