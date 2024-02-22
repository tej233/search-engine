<?php
// Establish database connection (replace with your connection details)
include "connection.php";

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$message = $_POST['message'];

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO feedback (name, email, contact_number, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $contact_number, $message);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    // Redirect to feedback form with success message
    header("Location: feedback.html?msg=success");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
