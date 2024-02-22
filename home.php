<?php
$keyword = $_POST["searchQuery"]; // Change 'GET' to 'POST'

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "searchEngine";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search query
$sql = "SELECT * FROM website WHERE website_title LIKE '%$keyword%' OR website_description LIKE '%$keyword%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Search Results for '$keyword':</h2>";
    echo "<div class='search-results'>";

    while($row = $result->fetch_assoc()) {
        $title = $row["website_title"];
        $link = $row["website_link"];
        $description = $row["website_description"];
        // $image = $row["website_image"];

        // Highlight keyword in title
        $title = str_ireplace($keyword, "<span style='color: blue;'>$keyword</span>", $title);

        // Display search result in Google-like format
        echo "<div class='result'>";
        echo "<h3><a href='$link' target='_blank' class='result-title'>$title</a></h3>";
        echo "<a href='$link' target='_blank' class='result-link'>$link</a>";
        echo "<p class='result-description'>$description</p>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<h2>No results found for '$keyword'.</h2>";
}

$conn->close();
?>
