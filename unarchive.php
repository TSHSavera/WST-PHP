<?php
// Unarchive a book

// Include the database configuration file
include 'dbconfig.php';

// Check for parameter
if(isset($_GET['id'])) {
    // Get the id parameter
    $id = $_GET['id'];

    // Prepare an update statement
    $sql = "UPDATE books SET isArchived = 0 WHERE id = $id";

    // Execute the statement
    if($conn->query($sql) === TRUE) {
        // Return a JSON success message
        echo json_encode(array('status' => 'success', 'message' => 'Book unarchived successfully'));
    } else {
        // Return a JSON error message
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
    }
} else {
    // Redirect back to a page
    header('Location: index.php?err_id=a&msg=Invalid request');
}