<!-- Form Processor for Adding Books -->
<?php
// Include the database connection file
include 'dbconfig.php';

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input form fields
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $isbn = $_POST['isbn'];
    $image = $_FILES['image']['name'];
    $target = UPLOAD_PATH . $image;
    $target_file = UPLOAD_PATH . basename($_FILES['image']['name']);

    // Check if the image file is a real image
    $check = getimagesize($_FILES['image']['tmp_name']);
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



    // Move the uploaded image to the upload directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Log to the console
        echo "<br>Image uploaded successfully";
    } else {
        // Log to the console
        echo "Failed to upload image";
        // Redirect back to a page
        header('Location: index.php?err_id=7');
    }

    // For redundancy: Convert image to blob data
    $blobimage = addslashes(file_get_contents(UPLOAD_PATH . basename($_FILES['image']['name'])));

    // Convert the date to MySQL date format
    echo "<br> Date Published: " . $_POST['date-published'];
    $datePublished = date('Y-m-d', strtotime($_POST['date-published']));

    


    // Insert the book details into the database
    // $sql = "INSERT INTO books (title, author, publisher, descr, category, datePublished, isbn, img, imgPath) VALUES ('$title', '$author', '$publisher', $description,  '$category', '$isbn', $datePublished,'$image', '$target')";
    $sql = "INSERT INTO books (title, author, publisher, descr, category, datePublished, isbn, img, imgPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssss', $title, $author, $publisher, $description, $category, $datePublished, $isbn, $image, $target);

    if($stmt->execute()) {
        // Redirect back to a page
        header('Location: index.php?res_id=1') ;
    } else {
        // Redirect back to a page
        header('Location: index.php?err_id=0');
    }
}
?>