<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if the email exists in the database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($result) > 0) {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(50));
        
        // Store the token in the database
        mysqli_query($conn, "UPDATE users SET reset_token='$token' WHERE email='$email'");
        
        // Send email with the reset link
        $resetLink = "http://localhost:8000/php/reset-password.php?token=$token";
        mail($email, "Password Reset Request", "Click this link to reset your password: $resetLink");
        
        $message = "<p class='success'>A password reset link has been sent to your email.</p>";
    } else {
        $message = "<p class='error'>Email not found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="../css/forgot-password.css"> <!-- New CSS -->
</head>
<body>
    <div class="container">
        <div class="envelope">
            <i class="fa fa-envelope"></i>
        </div>
        <h2>Forgot Password</h2>
        <form method="POST" action="">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
        <?php if (isset($message)) echo $message; ?>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>
