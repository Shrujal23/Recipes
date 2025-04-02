<?php

    include_once('header.php');
    echo '<link rel="stylesheet" href="../css/sign-up.css" type="text/css" />';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
    require_once 'connect.php';

    if(isset($_SESSION['u_id']) != "") {
        header("Location: index.php");
    }

    $error_count = 0;

    if (isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); 
        $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);

        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $name_error = "Name must contain only alphabets and space";
            $error_count++;
        }
        if(strlen($mobile_no) < 10) {
            $mobile_no_error = "Mobile number must of 10 characters";
            $error_count++;
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email ID";
            $error_count++;
        }
        if(strlen($password) < 6) {
            $password_error = "Password must be minimum of 6 characters";
            $error_count++;
        }       
        if($password != $c_password) {
            $c_password_error = "Password and Confirm Password doesn't match";
            $error_count++;
        }
    
        if($error_count == 0) {
            $r = mysqli_query($conn, "SELECT email FROM users");
            while($rowData = mysqli_fetch_array($r)) {
                if($rowData['email'] == $email) {
                    $email_error = "This email is already registered.";
                    $error_count++;
                    break;
                }
            }
            if($error_count == 0) {
                // Process profile image upload if provided
                $profileImagePath = "";
                if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                    $uploadsDir = "../uploads/";
                    $fileName = basename($_FILES['profile_image']['name']);
                    $targetFilePath = $uploadsDir . $fileName;
                    // Optionally, you can add validation for file type and size here
                    if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
                        $profileImagePath = $fileName;
                    }
                }
                
                // Insert profile image path into database if needed (adjust INSERT query accordingly)
                if (mysqli_query($conn, "INSERT INTO users(name, mobile, email, password, profile_image) VALUES('" . $name . "', '" . $mobile_no . "', '" . $email . "', '" . $password . "', '" . $profileImagePath . "')")) {
                    header("location: login.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
        mysqli_close($conn);
    }

?>

<main class="container-fluid">
    <div class="character-container">
        <div class="character">
            <div class="eye left"></div>
            <div class="eye right"></div>
            <div class="mouth"></div>
        </div>
    </div>
    
    <h1 class="mt-3 animate-pop">SIGN UP</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="animated-form">
        <div class="mb-2 form-group">
            <label for="full-name" class="form-label">Full name:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="full_name" id="full-name" class="form-control" required>
            </div>
            <?php if (isset($name_error)) echo '<span class="text-danger animate-shake">' . $name_error . '</span>'; ?>
        </div>

        <div class="mb-2 form-group">
            <label for="mobile-no" class="form-label">Mobile number:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input type="tel" name="mobile_no" id="mobile-no" class="form-control" required>
            </div>
            <?php if (isset($mobile_no_error)) echo '<span class="text-danger animate-shake">' . $mobile_no_error . '</span>'; ?>
        </div>

        <div class="mb-2 form-group">
            <label for="email" class="form-label">Email:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <?php if (isset($email_error)) echo '<span class="text-danger animate-shake">' . $email_error . '</span>'; ?>
        </div>

        <div class="mb-2 form-group">
            <label for="profile-image" class="form-label">Profile Image:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-image"></i></span>
                <input type="file" name="profile_image" id="profile-image" class="form-control">
            </div>
            <div id="preview-container" class="mt-2 d-none">
                <img id="image-preview" class="preview-img" alt="Preview">
            </div>
        </div>

        <div class="mb-2 form-group">
            <label for="password" class="form-label">Password:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary toggle-password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <?php if (isset($password_error)) echo '<span class="text-danger animate-shake">' . $password_error . '</span>'; ?>
        </div>

        <div class="mb-2 form-group">
            <label for="confirm-password" class="form-label">Re-enter password:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="c_password" id="confirm-password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary toggle-password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <?php if (isset($c_password_error)) echo '<span class="text-danger animate-shake">' . $c_password_error . '</span>'; ?>
        </div>

        <button type="submit" name="signup" id="submit" class="btn sign-up-btn w-100 mb-2">
            <span class="btn-text">Sign up</span>
            <span class="confetti">🎉</span>
        </button>
    </form>

    <p class="login-text">Already have an account? <a href="login.php" class="animate-link">Login!</a></p>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    document.getElementById('profile-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('preview-container');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('d-none');
                container.classList.add('animate-pop');
            }
            reader.readAsDataURL(file);
        }
    });

    // Password toggle functionality
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Character Animation
    const character = document.querySelector('.character');
    const inputs = document.querySelectorAll('.form-control');
    const eyes = document.querySelectorAll('.eye');
    const mouth = document.querySelector('.mouth');

    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            // Make character look excited
            eyes.forEach(eye => eye.style.height = '15px');
            mouth.style.transform = 'scale(1.2)';
            character.classList.add('bounce');
        });

        input.addEventListener('blur', () => {
            // Return to normal state
            eyes.forEach(eye => eye.style.height = '10px');
            mouth.style.transform = 'scale(1)';
            character.classList.remove('bounce');
        });

        input.addEventListener('input', () => {
            // Make character follow input
            character.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                character.style.transform = 'translateY(0)';
            }, 200);
        });
    });
});
</script>

<?php include_once('footer.php'); ?>