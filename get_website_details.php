<?php
// Include database connection file
include "connection.php";

// Fetch all website details
$sql_websites = "SELECT * FROM website";
$result_websites = $conn->query($sql_websites);

$website_details = array();

if ($result_websites->num_rows > 0) {
    while ($row = $result_websites->fetch_assoc()) {
        $website_details[] = array(
            'website_id' => $row['website_id'],
            'website_title' => $row['website_title'],
            'website_link' => $row['website_link'],
            'website_description' => $row['website_description'],
            'website_keywords' => $row['website_keywords'],
            'website_images' => $row['website_images']
        );
    }
}

// Convert website details to JSON format and output
echo json_encode($website_details);
?>
