<?php
// Include the database configuration file
include 'dbconfig.php';

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input form fields
    $id = $_POST['id-update'];
    $title = $_POST['title-update'];
    $author = $_POST['author-update'];
    $publisher = $_POST['publisher-update'];
    $description = $_POST['description-update'];
    $category = $_POST['category-update'];
    $isbn = $_POST['isbn-update'];
    $image = $_FILES['image-update']['name'];
    $target = UPLOAD_PATH . $image;
    $target_file = UPLOAD_PATH . basename($_FILES['image-update']['name']);
    $datePublished = date('Y-m-d', strtotime($_POST['date-published-update']));;

    // Check if id is empty
    if($id == '' || $id == null || !is_numeric($id)) {
        // Redirect back to a page
        echo "ID is empty";
        header('Location: index.php?err_id=a&msg=Invalid request');
        exit();
    }

    // Check if there is an image update - if none, do not update the image
    if($image == '') {
        // Check the input values
        if(empty($title) || empty($author) || empty($publisher) || empty($description) || empty($category) || empty($isbn)) {
            // Redirect back to a page
            header('Location: index.php?err_id=1');
        }

        // Check if the ISBN has atleast 4 dashes with 17 characters
        if (strlen($isbn) != 17) {
            // Check for the number of dashes
            $dashes = substr_count($isbn, '-');
            if ($dashes != 4) {
                // Redirect back to a page
                header('Location: index.php?err_id=2');
            }
        } else {
            // Check if the ISBN is unique
            $sql = "SELECT * FROM books WHERE isbn = '$isbn'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                // Redirect back to a page
                header('Location: index.php?err_id=3');
            }
        }

        // Execute the statement
        $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, publisher = ?, descr = ?, category = ?, datePublished = ?, isbn = ? WHERE id = ?");
        $stmt->bind_param("ssssssss", $title, $author, $publisher, $description, $category, $datePublished, $isbn, $id);
        
        if($stmt->execute()) {
            // Redirect back to a page
            header('Location: index.php?res_id=1');    
        } else {
            // Redirect back to a page
            header('Location: index.php?err_id=unknown&msg=' . $stmt->error);
        }

    } else {
        // Check if the image file is a real image
        $check = getimagesize($_FILES['image-update']['tmp_name']);
        if($check !== false) {
            // Echo the image details
            echo "File is an image - " . $check['mime'] . ".";
        } else {
            // Echo an error message
            echo "File is not an image.";
            // Redirect back to a page
            header('Location: index.php?err_id=5');
        }
        // Check if the file already exists
        if (file_exists($target)) {
            // Echo an error message
            echo "Sorry, file already exists.";
            // Redirect back to a page
            header('Location: index.php?err_id=6');
        }

        // Check the input values
        if(empty($title) || empty($author) || empty($publisher) || empty($description) || empty($category) || empty($isbn) || empty($image)) {
            // Redirect back to a page
            header('Location: index.php?err_id=1');
        }

        // Check if the ISBN has atleast 4 dashes with 17 characters
        if (strlen($isbn) != 17) {
            // Check for the number of dashes
            $dashes = substr_count($isbn, '-');
            if ($dashes < 4) {
                // Redirect back to a page
                header('Location: index.php?err_id=2');
            }
        } else {
            // Check if the ISBN is unique
            $sql = "SELECT * FROM books WHERE isbn = '$isbn'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                // Redirect back to a page
                header('Location: index.php?err_id=3');
            }
        }

        // Prepare an update statement
        $sql = "UPDATE books SET title = '$title', author = '$author', publisher = '$publisher', descr = '$description', category = '$category', datePublished = '$datePublished', isbn = '$isbn', img = '$image', imgPath = '$target_file' WHERE id = $id";

        // Execute the statement
        if($conn->query($sql) === TRUE) {
            // Move the uploaded image to the upload directory
            if(move_uploaded_file($_FILES['image-update']['tmp_name'], $target)) {
                // Redirect back to a page
                header('Location: index.php?res_id=1');
            } else {
                // Redirect back to a page
                header('Location: index.php?err_id=4');
            }
        } else {
            // Redirect back to a page
            header('Location: index.php?err_id=4');
        }
    }
}
?>