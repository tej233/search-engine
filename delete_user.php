<?php
include "connection.php";

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user record to display confirmation message
    $select_sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        // Display confirmation message
        echo "<script>
                var result = confirm('Do you really want to delete the user record for ".$username."?');
                if(result) {
                    window.location.href = 'delete_user_confirm.php?id=".$user_id."';
                } else {
                    window.location.href = 'user_details.php';
                }
            </script>";
    } else {
        // If no record found, redirect back to admin panel
        header("Location: user_details.php");
        exit();
    }
} else {
    // If ID parameter is not provided, redirect back to admin panel
    header("Location: user_details.php");
    exit();
}

// Close connection
$conn->close();
?>
