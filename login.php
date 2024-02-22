<?php
    session_start();
    include "connection.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["userName"];
        $password = $_POST["password"];

        // Secure way to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username; // Store username in session
            header("Location: index.html");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }

        $stmt->close();
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div id="login-form-wrap">
        <h2>Login</h2>
        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form id="login-form" action="login.php" method="post">
            <p>
                <input type="text" id="userName" name="userName" placeholder="Username" required>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </p>
            <p>
                <input type="submit" id="login" value="Login">
            </p>
        </form>
        <div id="create-account-wrap">
            <p>Not a member? <a href="register.html">Create Account</a>
            <p>
        </div>
    </div>
</body>
</html>
