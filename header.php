<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodMart 🛍️</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">

    <a href="index.php" class="logo">MoodMart 🛍️</a>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="index.php#moods">Moods</a>
        <a href="about.php">About</a>
    </div>

    <div class="nav-right">

        <?php if (isset($_SESSION['user'])): ?>

            <!-- Cart button with item count -->
            <a href="cart.php" class="cart-btn">
                🛒
                <?php
                if (isset($_SESSION['user_id']) && isset($conn)) {
                    $uid = $_SESSION['user_id'];
                    $cnt = mysqli_query($conn, "SELECT SUM(quantity) as total FROM cart WHERE user_id = $uid");
                    $cnt_row = mysqli_fetch_assoc($cnt);

                    // If cart has items show the number, otherwise show 0
                    if ($cnt_row['total'] > 0) {
                        $cart_count = $cnt_row['total'];
                    } else {
                        $cart_count = 0;
                    }

                    echo '<span class="cart-count">' . $cart_count . '</span>';
                }
                ?>
            </a>

            <span class="user-greeting">Hi, <?php echo $_SESSION['user']; ?>!</span>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="admin.php" class="btn admin-btn">⚙️ Admin</a>
            <?php endif; ?>

            <a href="logout.php" class="btn logout-btn">Logout</a>

        <?php else: ?>

            <a href="login.php" class="btn login-btn">Login</a>
            <a href="signup.php" class="btn signup-btn">Sign Up</a>

        <?php endif; ?>

        <button id="themeToggle" class="theme-btn" title="Toggle dark mode">🌙</button>

    </div>
</nav>

