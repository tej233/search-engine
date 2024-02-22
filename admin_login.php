<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided and match admin credentials
    if (isset($_POST['adminUserName']) && isset($_POST['adminPassword'])) {
        $adminUserName = $_POST['adminUserName'];
        $adminPassword = $_POST['adminPassword'];
        
        // Check if username and password are 'admin'
        if ($adminUserName === 'admin' && $adminPassword === 'admin') {
            // Redirect to admin panel
            header("Location: admin_panel.php");
            exit();
        } else {
            // Redirect to index.html with error message
            header("Location: login.html?error=invalid_credentials");
            exit();
        }
    }
}
?>
