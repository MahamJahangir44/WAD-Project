<?php
session_start();
include 'includes/db.php';

// check if user is logged in
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

    // check if all fields are filled
    if ($name == "" || $email == "" || $password == "" || $confirm == "") {
        $error = "Please fill in all fields.";

    // Check if passwords match
    } elseif ($password != $confirm) {
        $error = "Passwords do not match.";

    } else {
// prepared statement
        $check_stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");

        // bind the real value to placeholder
        mysqli_stmt_bind_param($check_stmt, "s", $email);

        // running the query
        mysqli_stmt_execute($check_stmt);

        // getting the result
        $check_result = mysqli_stmt_get_result($check_stmt);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "This email is already registered. Please login instead.";

        } else {

            // Hash the password before saving
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//prepared statement
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

            // bind the real value to placeholder
            mysqli_stmt_bind_param($insert_stmt, "sss", $name, $email, $hashed_password);

            // running the query
            if (mysqli_stmt_execute($insert_stmt)) {

                // prepared statement
                $get_stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
                mysqli_stmt_bind_param($get_stmt, "s", $email);
                mysqli_stmt_execute($get_stmt);
                $get_result = mysqli_stmt_get_result($get_stmt);
                $new_user   = mysqli_fetch_assoc($get_result);

                // Save in session 
                $_SESSION['user']    = $new_user['name'];
                $_SESSION['user_id'] = $new_user['id'];
                $_SESSION['role']    = $new_user['role'];

                mysqli_stmt_close($get_stmt);

                // Go to homepage
                header("Location: index.php");
                exit;

            } else {
                $error = "Something went wrong. Please try again.";
            }

            mysqli_stmt_close($insert_stmt);
        }

        mysqli_stmt_close($check_stmt);
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
