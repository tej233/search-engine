<?php
include "connection.php"; // Include your database connection file

// Check if ID is provided via GET parameter
if(isset($_GET['id'])) {
    $website_id = $_GET['id'];

    // Fetch website record based on ID
    $select_sql = "SELECT * FROM website WHERE website_id = $website_id";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $website_title = $row["website_title"];
        $website_link = $row["website_link"];
        $website_description = $row["website_description"];
        $website_keywords = $row["website_keywords"];
        $website_images = $row["website_images"];
    } else {
        // Redirect to admin panel with an error message if record not found
        header("Location: admin_panel.php?error=Record not found");
        exit();
    }
} else {
    // Redirect to admin panel if ID is not provided
    header("Location: admin_panel.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $new_website_title = $_POST['website_title'];
    $new_website_link = $_POST['website_link'];
    $new_website_description = $_POST['website_description'];
    $new_website_keywords = $_POST['website_keywords'];
    $new_website_images = $_POST['website_images'];

    // Update website record in the database
    $update_sql = "UPDATE website SET 
                    website_title = '$new_website_title',
                    website_link = '$new_website_link',
                    website_description = '$new_website_description',
                    website_keywords = '$new_website_keywords',
                    website_images = '$new_website_images'
                    WHERE website_id = $website_id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect to admin panel with a success message after updating
        header("Location: admin_panel.php?success=Record updated successfully");
        exit();
    } else {
        // Redirect to admin panel with an error message if update fails
        header("Location: admin_panel.php?error=Error updating record: " . $conn->error);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Edit Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
    background-color: grey; /* Light grey */
    font-family: Arial, sans-serif;
}

/* Container styles */
.container {
    margin-top: 50px; /* Add some spacing between navigation and content */
}

/* Form styles */
.form-group {
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ced4da; /* Grey */
    border-radius: 4px;
    box-sizing: border-box;
}

textarea.form-control {
    height: 150px; /* Set height for textarea */
}

.btn-primary {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    background-color: #007bff; /* Blue */
    color: #fff; /* White */
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3; /* Dark blue */
}
</style>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Website</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $website_id); ?>">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form-control" name="website_title" value="<?php echo $website_title; ?>">
            </div>
            <div class="form-group">
                <label>Link:</label>
                <input type="text" class="form-control" name="website_link" value="<?php echo $website_link; ?>">
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" name="website_description"><?php echo $website_description; ?></textarea>
            </div>
            <div class="form-group">
                <label>Keywords:</label>
                <input type="text" class="form-control" name="website_keywords" value="<?php echo $website_keywords; ?>">
            </div>
            <div class="form-group">
                <label>Images:</label>
                <textarea class="form-control" name="website_images"><?php echo $website_images; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
