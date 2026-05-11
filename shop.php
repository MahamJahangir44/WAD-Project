<?php
session_start();
include 'includes/db.php';

// Get mood filter from URL
$selected_mood = "";
if (isset($_GET['mood'])) {
    $selected_mood = $_GET['mood'];
}

// Handle Add to Cart
if (isset($_POST['add_to_cart'])) {

    // Must be logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $product_id = $_POST['product_id'];
    $user_id    = $_SESSION['user_id'];

    // PREPARED STATEMENT — check if product already in cart
    $check_stmt = mysqli_prepare($conn, "SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    // "ii" means two integers
    mysqli_stmt_bind_param($check_stmt, "ii", $user_id, $product_id);
    mysqli_stmt_execute($check_stmt);
    $check = mysqli_stmt_get_result($check_stmt);
    mysqli_stmt_close($check_stmt);

    if (mysqli_num_rows($check) > 0) {
        // Already in cart — increase quantity by 1
        $upd_stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($upd_stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($upd_stmt);
        mysqli_stmt_close($upd_stmt);
    } else {
        // Not in cart — add it
        $ins_stmt = mysqli_prepare($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
        mysqli_stmt_bind_param($ins_stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($ins_stmt);
        mysqli_stmt_close($ins_stmt);
    }

    header("Location: shop.php?added=1&mood=" . $selected_mood);
    exit;
}

// Get products from database
if ($selected_mood != "") {
    // PREPARED STATEMENT — fetch products by mood
    $prod_stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE mood = ? ORDER BY id DESC");
    mysqli_stmt_bind_param($prod_stmt, "s", $selected_mood);
    mysqli_stmt_execute($prod_stmt);
    $products = mysqli_stmt_get_result($prod_stmt);
} else {
    // No mood filter — get all products
    $products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
}

include 'includes/header.php';
?>

<!-- Shop Hero -->
<div class="shop-hero">
    <?php if ($selected_mood != ""): ?>
        <h1>
            <?php
            // Pick emoji for the mood
            if ($selected_mood == "happy")       { echo "😄"; }
            elseif ($selected_mood == "calm")    { echo "😌"; }
            elseif ($selected_mood == "sad")     { echo "😢"; }
            elseif ($selected_mood == "energetic") { echo "⚡"; }
            elseif ($selected_mood == "stressed")  { echo "😣"; }
            elseif ($selected_mood == "adventurous") { echo "🌍"; }
            elseif ($selected_mood == "focused") { echo "🎯"; }
            ?>
            <?php
            // Capitalize first letter manually
            echo strtoupper(substr($selected_mood, 0, 1)) . substr($selected_mood, 1);
            ?>
            Picks
        </h1>
        <p>Products handpicked for your <?php echo $selected_mood; ?> mood</p>
    <?php else: ?>
        <h1>🛍️ All Products</h1>
        <p>Browse everything — or filter by mood below</p>
    <?php endif; ?>
</div>

<!-- Show toast when item is added -->
<?php if (isset($_GET['added'])): ?>
<script>
    window.addEventListener("load", function() {
        showToast("✅ Added to cart!", "success");
    });
</script>
<?php endif; ?>

<!-- Mood Filter Bar -->
<div class="mood-filter-bar">
    <a href="shop.php"                  class="filter-btn <?php if($selected_mood == '')           { echo 'active'; } ?>">🛍️ All</a>
    <a href="shop.php?mood=happy"       class="filter-btn <?php if($selected_mood == 'happy')      { echo 'active'; } ?>">😄 Happy</a>
    <a href="shop.php?mood=calm"        class="filter-btn <?php if($selected_mood == 'calm')       { echo 'active'; } ?>">😌 Calm</a>
    <a href="shop.php?mood=sad"         class="filter-btn <?php if($selected_mood == 'sad')        { echo 'active'; } ?>">😢 Sad</a>
    <a href="shop.php?mood=energetic"   class="filter-btn <?php if($selected_mood == 'energetic')  { echo 'active'; } ?>">⚡ Energetic</a>
    <a href="shop.php?mood=stressed"    class="filter-btn <?php if($selected_mood == 'stressed')   { echo 'active'; } ?>">😣 Stressed</a>
    <a href="shop.php?mood=adventurous" class="filter-btn <?php if($selected_mood == 'adventurous'){ echo 'active'; } ?>">🌍 Adventurous</a>
    <a href="shop.php?mood=focused"     class="filter-btn <?php if($selected_mood == 'focused')    { echo 'active'; } ?>">🎯 Focused</a>
</div>

<!-- Products Grid -->
<div class="products-section">

    <?php if (!$products || mysqli_num_rows($products) == 0): ?>

        <div class="no-products">
            <div class="emoji">😕</div>
            <p>No products found for this mood yet.</p>
            <a href="shop.php" style="color:var(--purple); font-weight:600;">← See all products</a>
        </div>

    <?php else: ?>

        <div class="products-grid">

            <?php while ($product = mysqli_fetch_assoc($products)): ?>

                <div class="product-card">

                    <img
                        src="<?php echo $product['image']; ?>"
                        alt="<?php echo $product['name']; ?>"
                        class="product-image"
                        onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&q=80'"
                    >

                    <div class="product-info">

                        <span class="product-mood-tag"><?php echo $product['mood']; ?></span>

                        <h3 class="product-name"><?php echo $product['name']; ?></h3>

                        <p class="product-desc"><?php echo $product['description']; ?></p>

                        <div class="product-footer">

                            <span class="product-price">Rs. <?php echo $product['price']; ?></span>

                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                                    🛒 Add
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>