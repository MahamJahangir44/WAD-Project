<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get order_id from URL
$order_id = $_GET['order_id'];

$order_result = mysqli_query($conn, "SELECT * FROM orders WHERE id = $order_id AND user_id = " . $_SESSION['user_id']);

if (mysqli_num_rows($order_result) == 0) {
    header("Location: index.php");
    exit;
}

$order = mysqli_fetch_assoc($order_result);

include 'includes/header.php';
?>

<div class="success-page">
    <div class="success-box">

        <div class="success-icon">🎉</div>

        <h1>Order Placed!</h1>

        <p>
            Thank you, <strong><?php echo $_SESSION['user']; ?></strong>!
            Your order has been received and will be delivered soon.
        </p>

        <div class="order-id-badge">
            Order #<?php echo $order_id; ?>
        </div>

        <p>📍 Delivering to: <strong><?php echo $order['address']; ?></strong></p>

        <p style="margin-top:8px;">
            💰 Total: <strong>Rs. <?php echo $order['total_amount']; ?></strong>
        </p>

        <div class="success-actions" style="margin-top:30px;">
            <a href="shop.php" class="btn-primary-action">🛍️ Shop More</a>
            <a href="index.php" class="btn-secondary-action">🏠 Home</a>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>