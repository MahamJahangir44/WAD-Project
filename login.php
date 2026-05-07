<?php
session_start();
include 'includes/db.php';

// Check if already logged in or not
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "" || $password == "") {
        $error = "Please enter your email and password.";
    } else {

        // Find user by email only first
        $sql    = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {

            $user = mysqli_fetch_assoc($result);

            // Checks if typed password matches the hashed one in the database
            if (password_verify($password, $user['password'])) {

                // Log if password matches
                $_SESSION['user']    = $user['name'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role']    = $user['role'];

                // Admin goes to admin panel, normal user goes to homepage
                if ($user['role'] == 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: index.php");
                }
                exit;

            } else {
                // Password did not match
                $error = "Incorrect email or password. Please try again.";
            }

        } else {
            // No user found with that email
            $error = "Incorrect email or password. Please try again.";
        }
    }
}

include 'includes/header.php';
?>

<div class="auth-page">
    <div class="auth-box">

        <div class="auth-icon">👋</div>
        <h2>Welcome Back</h2>
        <p class="subtitle">Login to continue your MoodMart journey</p>

        <?php if ($error != ""): ?>
            <div class="alert alert-error">❌ <?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST" id="loginForm">

            <div class="input-group">
                <input type="email" name="email" id="loginEmail" placeholder=" " required>
                <label>Email Address</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" id="loginPassword" placeholder=" " required>
                <label>Password</label>
            </div>

            <button type="submit" name="login" class="auth-submit-btn">Login 🔐</button>

        </form>

        <p class="auth-extra">
            Don't have an account? <a href="signup.php">Sign up free</a>
        </p>

    </div>
</div>

<?php include 'includes/footer.php'; ?>
