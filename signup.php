<?php
session_start();
include 'includes/db.php';

// Check if already logged in 
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Check all fields are filled
    if ($name == "" || $email == "" || $password == "" || $confirm == "") {
        $error = "Please fill in all fields.";

    // Check passwords match
    } elseif ($password != $confirm) {
        $error = "Passwords do not match.";

    } else {

        // Check if this email already has an account
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");

        if (mysqli_num_rows($check) > 0) {
            $error = "This email is already registered. Please login instead.";

        } else {

            // Hash the password before saving
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Save the new user in database 
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {

                // Get the new user's info 
                $get_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
                $new_user = mysqli_fetch_assoc($get_user);

                // Save in session for auto login
                $_SESSION['user']    = $new_user['name'];
                $_SESSION['user_id'] = $new_user['id'];
                $_SESSION['role']    = $new_user['role'];

                // Go to homepage
                header("Location: index.php");
                exit;

            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="auth-page">
    <div class="auth-box">

        <div class="auth-icon">✨</div>
        <h2>Create Account</h2>
        <p class="subtitle">Join MoodMart and start shopping by mood</p>

        <?php if ($error != ""): ?>
            <div class="alert alert-error">❌ <?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST" id="signupForm">

            <div class="input-group">
                <input type="text" name="name" id="signupName" placeholder=" " required>
                <label>Full Name</label>
            </div>
            <!-- JS will show error message here -->
            <small id="nameError" class="js-error"></small>

            <div class="input-group">
                <input type="email" name="email" id="signupEmail" placeholder=" " required>
                <label>Email Address</label>
            </div>
            <small id="emailError" class="js-error"></small>

            <div class="input-group">
                <input type="password" name="password" id="signupPassword" placeholder=" " required>
                <label>Password</label>
            </div>
            <small id="passwordError" class="js-error"></small>

            <div class="input-group">
                <input type="password" name="confirm_password" id="signupConfirm" placeholder=" " required>
                <label>Confirm Password</label>
            </div>
            <small id="confirmError" class="js-error"></small>

            <button type="submit" name="submit" class="auth-submit-btn">Create Account 🚀</button>

        </form>

        <p class="auth-extra">
            Already have an account? <a href="login.php">Login here</a>
        </p>

    </div>
</div>

<?php include 'includes/footer.php'; ?>
