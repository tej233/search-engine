<?php
include "connection.php";

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete the user record from the database
    $delete_sql = "DELETE FROM users WHERE id = $user_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        // Redirect back to admin panel with success message
        header("Location: user_details.php?msg=user_delete_success");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If ID parameter is not provided, redirect back to admin panel
    header("Location: user_details.php");
    exit();
}

// Close connection
$conn->close();
?>
