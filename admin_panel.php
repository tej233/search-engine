<?php
include "connection.php";

$website_sql = "SELECT * FROM website";
$website_result = $conn->query($website_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Website Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
    background-color: #f8f9fa; 
    font-family: Arial, sans-serif;
}

/* Navigation bar styles */
.navbar {
    background-color: #343a40; 
}

.navbar-brand, .navbar-nav .nav-link {
    color: #ffffff !important; /* White */
}

.navbar-brand:hover, .navbar-nav .nav-link:hover {
    color: #ffffff !important; /* White */
}

/* Container styles */
.container {
    margin-top: 50px; 
}

/* Table styles */
.table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    background-color: #ffffff; /* White */
    border: 1px solid #dee2e6;
}

.table th, .table td {
    padding: 8px;
    border-bottom: 1px solid #dee2e6;
}

.table th {
    background-color: #343a40; /* Dark grey */
    color: #ffffff; /* White */
    font-weight: bold;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Light grey */
}

/* Actions links styles */
.table a {
    color: #007bff; /* Blue */
    text-decoration: none;
}

.table a:hover {
    text-decoration: underline;
    color: #0056b3; /* Dark blue */
}
        /* Custom styles for navigation bar */
        .navbar {
            background-color: #343a40; /* Dark grey */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important; /* White */
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #ffffff !important; /* White */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="admin_panel.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_panel.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_details.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_website.html">Add Website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Website Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Website ID</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Description</th>
                    <th>Keywords</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display data from the website table
                if ($website_result->num_rows > 0) {
                    while($row = $website_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["website_id"]."</td>";
                        echo "<td>".$row["website_title"]."</td>";
                        echo "<td>".$row["website_link"]."</td>";
                        echo "<td>".$row["website_description"]."</td>";
                        echo "<td>".$row["website_keywords"]."</td>";
                        echo "<td>".$row["website_images"]."</td>";
                        echo "<td>";
                        echo "<a href='edit_website.php?id=".$row["website_id"]."'>Edit</a> | ";
                        echo "<a href='delete_website.php?id=".$row["website_id"]."'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>

