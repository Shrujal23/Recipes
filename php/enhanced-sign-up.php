<?php
session_start();
$error_message = "";

include_once('header.php');
echo '<link rel="stylesheet" href="../css/sign-up.css" type="text/css" />';
require_once 'connect.php';

if (isset($_POST['sign_up'])) {
    // Sign-up logic here
}

?>

<main class="container content-wrapper shadow-lg">
    <div class="row mt-4">
        <!-- Sign Up Form Section -->
        <section class="col-md-5 col-lg-5 col-sm-12 my-auto px-4 sign-up-section">
            <h1 class="mt-5 mt-md-0">SIGN UP</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-md-5 mt-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Enter Name</label>
                    <input type="text" name="name" id="username" class="form-control" placeholder="Your Name" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Enter Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Your Password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Your Password" required>
                </div>
                <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
                <input type="submit" name="sign_up" id="submit" class="form-control btn mb-4 sign-up-btn" value="Sign Up">
            </form>
            <p class="login">Already have an account? <a href="login.php">Log in!</a></p>
        </section>

        <!-- Display Image Section -->
        <section class="col-md-7 col-lg-7 d-none d-md-block my-auto px-0 display-image-section">
