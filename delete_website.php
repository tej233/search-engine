<?php
include "connection.php";

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    $website_id = $_GET['id'];

    // Fetch the website record to display confirmation message
    $select_sql = "SELECT * FROM website WHERE website_id = $website_id";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $website_title = $row["website_title"];
        // Display confirmation message
        echo "<script>
                var result = confirm('Do you really want to delete the website record for ".$website_title."?');
                if(result) {
                    window.location.href = 'delete_website_confirm.php?id=".$website_id."';
                } else {
                    window.location.href = 'admin_panel.php';
                }
            </script>";
    } else {
        // If no record found, redirect back to admin panel
        header("Location: admin_panel.php");
        exit();
    }
} else {
    // If ID parameter is not provided, redirect back to admin panel
    header("Location: admin_panel.php");
    exit();
}

// Close connection
$conn->close();
?>
