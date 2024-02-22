<?php
include "connection.php";

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    $website_id = $_GET['id'];

    // Delete the website record from the database
    $delete_sql = "DELETE FROM website WHERE website_id = $website_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        // Redirect back to admin panel with success message
        header("Location: admin_panel.php?msg=delete_success");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If ID parameter is not provided, redirect back to admin panel
    header("Location: admin_panel.php");
    exit();
}

// Close connection
$conn->close();
?>
