<?php
include "connection.php";

// Fetch data from the users table
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - User Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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

        /* Table styles */
        h2 {
            margin-top: 30px;
            margin-bottom: 20px;
            color: #333; /* Dark grey */
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            vertical-align: middle;
            text-align: center;
        }

        .table thead th {
            background-color: #007bff; /* Blue */
            color: #fff; /* White */
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Light grey */
        }

        .table a {
            color: #007bff; /* Blue */
        }

        .table a:hover {
            text-decoration: none;
            color: #0056b3; /* Dark blue */
            
        }
        .body {
            background-image: url('user_details_background_image.jpg');
            background-size: cover;
            background-repeat: no-repeat;
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
<h2>Users Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display data from the users table
                if ($users_result->num_rows > 0) {
                    while($row = $users_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["username"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["created_at"]."</td>";
                        echo "<td>".$row["updated_at"]."</td>";
                        echo "<td>";
                        echo "<a href='delete_user.php?id=".$row["id"]."'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
    // Check if the URL contains the success message
    var urlParams = new URLSearchParams(window.location.search);
    var msg = urlParams.get('msg');

    // Display alert message if the success message is present
    if (msg === 'success') {
        alert('Details updated successfully!');
    }
</script>
</body>
</html>