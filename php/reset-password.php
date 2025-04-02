<?php
require_once 'connect.php';

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);
    
    // Check if the token is valid
    $result = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$token'");
    
    if (mysqli_num_rows($result) > 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update the password and clear the reset token
            mysqli_query($conn, "UPDATE users SET password='$hashedPassword', reset_token=NULL WHERE reset_token='$token'");
            echo "<p>Your password has been reset successfully.</p>";
        }
    } else {
        echo "<p>Invalid token.</p>";
    }
} else {
    echo "<p>No token provided.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/login.css"> <!-- Include existing CSS -->
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST" action="">
            <input type="password" name="new_password" placeholder="Enter new password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
