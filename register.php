<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];


    // Hash the password for security


    $sql = "INSERT INTO users ( username, email, phone_number, password) VALUES ( '$username', '$email', '$phone_number', '$password')";

    if ($conn->query($sql) === true) {
        // Registration successful, redirect to login page
        header("Location: login.html?success=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>