<?php
include "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['websiteTitle'];
    $link = $_POST['websiteLink'];
    $description = $_POST['websiteDescription'];
    $keywords = $_POST['websiteKeywords'];
    $images = $_POST['websiteImages'];

    // Insert data into the website table
    $insert_sql = "INSERT INTO website (website_title, website_link, website_description, website_keywords, website_images) 
                   VALUES ('$title', '$link', '$description', '$keywords', '$images')";

    if ($conn->query($insert_sql) === TRUE) {
        // Redirect back to add_website.html with success message
        header("Location: add_website.html?msg=success");
        exit();
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
