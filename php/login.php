<?php
session_start();
$error_message = "";

include_once('header.php');
echo '<link rel="stylesheet" href="../css/login.css" type="text/css" />';
require_once 'connect.php';

if (isset($_SESSION['u_id']) && $_SESSION['u_id'] != "") {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' and password = '$password'");
    if (!empty($result)) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['u_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['mobile_no'] = $row['mobile'];
            $type = $row['admin'];
            if ($type == true) {
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error_message = "Incorrect Email or Password!!!";
        }
    } else {
        $error_message = "Incorrect Email or Password!!!";
    }
}
?>

<main class="container content-wrapper shadow-lg">
    <div class="row mt-4">
        <!-- Login Form Section -->
        <section class="col-md-5 col-lg-5 col-sm-12 my-auto px-4 login-section">
            <h1 class="mt-5 mt-md-0">LOGIN</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-md-5 mt-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Enter Email</label>
                    <input type="text" name="email" id="username" class="form-control" placeholder="email@example.com" required autofocus>
                    <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Your Password" required>
                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                </div>
                <p class="forgot-password mb-3"><a href="forgot-password.php">Forgot password?</a></p>
                <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
                <input type="submit" name="login" id="submit" class="form-control btn mb-4 log-in-btn" value="Log in">
            </form>
            <p class="sign-up">Don't have an account? <a href="sign-up.php">Sign up!</a></p>
        </section>

        <!-- Display Image Section -->
        <section class="col-md-7 col-lg-7 d-none d-md-block my-auto px-0 display-image-section">
            <img src="../images/login-display-image.jpg" alt="Login Display Image" class="img-fluid">
        </section>
    </div>
</main>

<?php include_once('footer.php'); ?>
