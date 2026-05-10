<?php
session_start();
include 'includes/db.php';

// logged in users
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get cart items
$cart_result = mysqli_query($conn, "
    SELECT cart.id as cart_id, cart.quantity, cart.product_id,
           products.name, products.price, products.image
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

$items       = array();
$total       = 0;
$item_count  = 0;

while ($item = mysqli_fetch_assoc($cart_result)) {
    $item['subtotal'] = $item['price'] * $item['quantity'];
    $total            = $total + $item['subtotal'];
    $item_count       = $item_count + 1;
    $items[]          = $item;
}

// If cart is empty then go back to cart page
if ($item_count == 0) {
    header("Location: cart.php");
    exit;
}

$shipping    = 200;
$grand_total = $total + $shipping;

$error = "";

// place order 
if (isset($_POST['place_order'])) {

    $full_name = $_POST['full_name'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];
    $city      = $_POST['city'];
    $payment   = $_POST['payment_method'];

    // Check all fields are filled
    if ($full_name == "" || $phone == "" || $address == "" || $city == "") {
        $error = "Please fill in all delivery details.";

    } else {

        $full_address = $address . ", " . $city;

        // Save data to database
        mysqli_query($conn, "INSERT INTO orders (user_id, total_amount, address, status)
                             VALUES ($user_id, $grand_total, '$full_address', 'pending')");

       
    $order_id_result = mysqli_query($conn, "SELECT id FROM orders WHERE user_id = $user_id ORDER BY id DESC LIMIT 1");
        $order_id_row    = mysqli_fetch_assoc($order_id_result);
        $order_id        = $order_id_row['id'];

        // Save each product in order_items table
        foreach ($items as $item) {
            $p_id  = $item['product_id'];
            $qty   = $item['quantity'];
            $price = $item['price'];
            mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price)
                                 VALUES ($order_id, $p_id, $qty, $price)");
        }

      
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

        // Go to success page
        header("Location: order_success.php?order_id=" . $order_id);
        exit;
    }
}

include 'includes/header.php';
?>

<div class="page-wrapper">

    <h1 class="page-title">💳 Checkout</h1>

    <?php if ($error != ""): ?>
        <div class="alert alert-error" style="max-width:700px; margin-bottom:20px;">❌ <?php echo $error; ?></div>
    <?php endif; ?>

    <div class="checkout-layout">

        <!-- LEFT: Form -->
        <form action="" method="POST">

            <!-- Delivery Details -->
            <div class="checkout-form">

                <h3>📦 Delivery Details</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="Your full name" value="<?php echo $_SESSION['user']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" placeholder="03XX-XXXXXXX" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" name="address" placeholder="House no., Street, Area" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="Islamabad" required>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" value="Pakistan" readonly>
                    </div>
                </div>

            </div>

            <!-- Payment Method -->
            <div class="checkout-form" style="margin-top: 20px;">

                <h3>💳 Payment Method</h3>

                <div class="payment-methods">

                    <div class="payment-option">
                        <input type="radio" id="cod" name="payment_method" value="Cash on Delivery" checked>
                        <label for="cod">💵 Cash on Delivery</label>
                    </div>

                    <div class="payment-option">
                        <input type="radio" id="easypaisa" name="payment_method" value="Easypaisa">
                        <label for="easypaisa">📱 Easypaisa</label>
                    </div>

                    <div class="payment-option">
                        <input type="radio" id="jazzcash" name="payment_method" value="JazzCash">
                        <label for="jazzcash">💳 JazzCash</label>
                    </div>

                    <div class="payment-option">
                        <input type="radio" id="card" name="payment_method" value="Credit/Debit Card">
                        <label for="card">🏦 Credit / Debit Card</label>
                    </div>

                </div>

                <button type="submit" name="place_order" class="place-order-btn">
                    🎉 Place Order — Rs. <?php echo $grand_total; ?>
                </button>

            </div>

        </form>
        <div>
            <div class="order-summary">

                <h3>Your Order</h3>

                <?php foreach ($items as $item): ?>
                    <div style="display:flex; gap:12px; align-items:center; margin-bottom:15px; padding-bottom:15px; border-bottom:1px solid var(--border);">
                        <img src="<?php echo $item['image']; ?>"
                             style="width:55px;height:55px;border-radius:10px;object-fit:cover;"
                             onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=200&q=80'">
                        <div style="flex:1;">
                            <div style="font-weight:600; font-size:14px;"><?php echo $item['name']; ?></div>
                            <div style="color:var(--text-gray); font-size:13px;">Qty: <?php echo $item['quantity']; ?></div>
                        </div>
                        <div style="font-weight:700; font-size:14px;">Rs. <?php echo $item['subtotal']; ?></div>
                    </div>
                <?php endforeach; ?>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rs. <?php echo $total; ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Rs. <?php echo $shipping; ?></span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>Rs. <?php echo $grand_total; ?></span>
                </div>

            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>