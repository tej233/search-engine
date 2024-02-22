<?php
// Include database connection file
include "connection.php";

// Fetch all users' details
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);

$user_details = array();

if ($result_users->num_rows > 0) {
    while ($row = $result_users->fetch_assoc()) {
        $user_details[] = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'email' => $row['email']
        );
    }
}

// Convert user details to JSON format and output
echo json_encode($user_details);
?>
