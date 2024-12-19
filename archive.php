<?php
// Archive a book
// Include the database configuration file
include 'dbconfig.php';

// Check for parameter
if(isset($_GET['id'])) {
    // Get the id parameter
    $id = $_GET['id'];

    // Prepare an update statement
    $sql = "UPDATE books SET isArchived = 1 WHERE id = $id";

    // Execute the statement
    if($conn->query($sql) === TRUE) {
        // Redirect back to a page
        echo "Book archived successfully";
    } else {
        // Echo an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Redirect back to a page
    header('Location: index.php?err_id=a&msg=Invalid request');
}