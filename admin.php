<?php
session_start();
include 'includes/db.php';

// Only admin can access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// handle add product
if (isset($_POST['add_product'])) {
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $image       = $_POST['image'];
    $mood        = $_POST['mood'];
    $category    = $_POST['category'];
    $stock       = $_POST['stock'];

     // prepare SQL query
    $stmt = mysqli_prepare($conn,
        "INSERT INTO products
        (name, description, price, image, mood, category, stock)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    // bind values to placeholders
    mysqli_stmt_bind_param(
        $stmt,
        "ssdsssi",
        $name,
        $description,
        $price,
        $image,
        $mood,
        $category,
        $stock
    );

    // execute query
    mysqli_stmt_execute($stmt);

    // close statement
    mysqli_stmt_close($stmt);

    // redirect
    header("Location: admin.php?tab=products&msg=added");
    exit;
}

// handle delete product
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $product_id");
    header("Location: admin.php?tab=products&msg=deleted");
    exit;
}

// handle update order status
if (isset($_POST['update_status'])) {
    $order_id   = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    mysqli_query($conn, "UPDATE orders SET status = '$new_status' WHERE id = $order_id");
    header("Location: admin.php?tab=orders");
    exit;
}

// handle delete user
if (isset($_POST['delete_user'])) {
    $del_user_id = $_POST['user_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $del_user_id AND role != 'admin'");
    header("Location: admin.php?tab=users");
    exit;
}

// get stats
$users_result    = mysqli_query($conn, "SELECT id FROM users");
$total_users     = mysqli_num_rows($users_result);

$products_result = mysqli_query($conn, "SELECT id FROM products");
$total_products  = mysqli_num_rows($products_result);

$orders_result   = mysqli_query($conn, "SELECT id FROM orders");
$total_orders    = mysqli_num_rows($orders_result);

// Total revenue — add up all order amounts
$revenue_result  = mysqli_query($conn, "SELECT SUM(total_amount) as revenue FROM orders");
$revenue_row     = mysqli_fetch_assoc($revenue_result);

if ($revenue_row['revenue'] != "") {
    $total_revenue = $revenue_row['revenue'];
} else {
    $total_revenue = 0;
}

$all_users    = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
$all_products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$all_orders   = mysqli_query($conn, "
    SELECT orders.*, users.name as user_name, users.email
    FROM orders
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.id DESC
");

// Which tab to show
if (isset($_GET['tab'])) {
    $active_tab = $_GET['tab'];
} else {
    $active_tab = 'overview';
}

include 'includes/header.php';
?>

<div class="admin-layout">

    <!-- left sidebar -->
    <div class="admin-sidebar">

        <div class="sidebar-title">Admin Panel</div>

        <a href="admin.php?tab=overview"    class="sidebar-link <?php if($active_tab == 'overview')    { echo 'active'; } ?>"><span class="sidebar-icon">📊</span> Overview</a>
        <a href="admin.php?tab=orders"      class="sidebar-link <?php if($active_tab == 'orders')      { echo 'active'; } ?>"><span class="sidebar-icon">📦</span> Orders</a>
        <a href="admin.php?tab=products"    class="sidebar-link <?php if($active_tab == 'products')    { echo 'active'; } ?>"><span class="sidebar-icon">🛍️</span> Products</a>
        <a href="admin.php?tab=users"       class="sidebar-link <?php if($active_tab == 'users')       { echo 'active'; } ?>"><span class="sidebar-icon">👥</span> Users</a>
        <a href="admin.php?tab=add_product" class="sidebar-link <?php if($active_tab == 'add_product') { echo 'active'; } ?>"><span class="sidebar-icon">➕</span> Add Product</a>

        <a href="index.php" class="sidebar-link" style="margin-top:20px; border-top:1px solid rgba(255,255,255,0.1); padding-top:20px;">
            <span class="sidebar-icon">🏠</span> Back to Site
        </a>

    </div>

    <!-- main content -->
    <div class="admin-main">


        <!-- Overview tab -->
        <?php if ($active_tab == 'overview'): ?>

            <div class="admin-header">
                <h1>Welcome back, Admin! 👋</h1>
                <p>Here's what's happening with MoodMart.</p>
            </div>

            <!-- 4 stat cards-->
            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-card-icon">👥</div>
                    <div class="stat-card-number"><?php echo $total_users; ?></div>
                    <div class="stat-card-label">Total Users</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-icon">🛍️</div>
                    <div class="stat-card-number"><?php echo $total_products; ?></div>
                    <div class="stat-card-label">Products</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-icon">📦</div>
                    <div class="stat-card-number"><?php echo $total_orders; ?></div>
                    <div class="stat-card-label">Total Orders</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-icon">💰</div>
                    <div class="stat-card-number">Rs. <?php echo $total_revenue; ?></div>
                    <div class="stat-card-label">Total Revenue</div>
                </div>

            </div>

            <!-- Recent orders table -->
            <div class="admin-section">
                <h3>📦 Recent Orders</h3>

                <?php
                $recent_orders = mysqli_query($conn, "
                    SELECT orders.*, users.name as user_name
                    FROM orders JOIN users ON orders.user_id = users.id
                    ORDER BY orders.id DESC LIMIT 5
                ");
                ?>

                <?php if (mysqli_num_rows($recent_orders) == 0): ?>
                    <p style="color:var(--text-gray);">No orders yet.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($o = mysqli_fetch_assoc($recent_orders)): ?>
                                <tr>
                                    <td>#<?php echo $o['id']; ?></td>
                                    <td><?php echo $o['user_name']; ?></td>
                                    <td>Rs. <?php echo $o['total_amount']; ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $o['status']; ?>">
                                            <?php echo $o['status']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $o['created_at']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>


        <!-- Orders tab -->
        <?php elseif ($active_tab == 'orders'): ?>

            <div class="admin-header">
                <h1>📦 All Orders</h1>
                <p>Manage and update order statuses.</p>
            </div>

            <div class="admin-section">

                <?php if (mysqli_num_rows($all_orders) == 0): ?>
                    <p style="color:var(--text-gray);">No orders placed yet.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($o = mysqli_fetch_assoc($all_orders)): ?>
                                <tr>
                                    <td>#<?php echo $o['id']; ?></td>
                                    <td><?php echo $o['user_name']; ?></td>
                                    <td><?php echo $o['email']; ?></td>
                                    <td><?php echo $o['address']; ?></td>
                                    <td>Rs. <?php echo $o['total_amount']; ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $o['status']; ?>">
                                            <?php echo $o['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="" method="POST" style="display:flex; gap:5px;">
                                            <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                            <select name="new_status" style="padding:5px 8px; border-radius:8px; border:1px solid var(--border); font-family:'DM Sans',sans-serif; font-size:13px; background:var(--white); color:var(--text-dark);">
                                                <option value="pending"   <?php if($o['status'] == 'pending')   { echo 'selected'; } ?>>Pending</option>
                                                <option value="delivered" <?php if($o['status'] == 'delivered') { echo 'selected'; } ?>>Delivered</option>
                                                <option value="cancelled" <?php if($o['status'] == 'cancelled') { echo 'selected'; } ?>>Cancelled</option>
                                            </select>
                                            <button type="submit" name="update_status"
                                                style="padding:5px 12px; background:var(--gradient); color:white; border:none; border-radius:8px; cursor:pointer; font-size:12px; font-family:'DM Sans',sans-serif;">
                                                Save
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>


        <!-- Products tab -->
        <?php elseif ($active_tab == 'products'): ?>

            <div class="admin-header">
                <h1>🛍️ All Products</h1>
                <p>View and delete products.</p>
            </div>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success" style="margin-bottom:20px;">
                    ✅ Product <?php echo $_GET['msg']; ?> successfully!
                </div>
            <?php endif; ?>

            <div class="admin-section">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Mood</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($p = mysqli_fetch_assoc($all_products)): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $p['image']; ?>"
                                         style="width:50px;height:50px;border-radius:8px;object-fit:cover;"
                                         onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=100&q=80'">
                                </td>
                                <td><?php echo $p['name']; ?></td>
                                <td><?php echo $p['mood']; ?></td>
                                <td><?php echo $p['category']; ?></td>
                                <td>Rs. <?php echo $p['price']; ?></td>
                                <td><?php echo $p['stock']; ?></td>
                                <td>
                                    <form action="" method="POST" onsubmit="return confirm('Delete this product?')">
                                        <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                                        <button type="submit" name="delete_product"
                                            style="padding:6px 14px; background:#fee2e2; color:#dc2626; border:none; border-radius:8px; cursor:pointer; font-size:13px; font-family:'DM Sans',sans-serif;">
                                            🗑 Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>


        <!-- Users tab -->
        <?php elseif ($active_tab == 'users'): ?>

            <div class="admin-header">
                <h1>👥 All Users</h1>
                <p>See who has signed up.</p>
            </div>

            <div class="admin-section">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($u = mysqli_fetch_assoc($all_users)): ?>
                            <tr>
                                <td>#<?php echo $u['id']; ?></td>
                                <td><?php echo $u['name']; ?></td>
                                <td><?php echo $u['email']; ?></td>
                                <td>
                                    <span class="status-badge <?php if($u['role'] == 'admin') { echo 'status-delivered'; } else { echo 'status-pending'; } ?>">
                                        <?php echo $u['role']; ?>
                                    </span>
                                </td>
                                <td><?php echo $u['created_at']; ?></td>
                                <td>
                                    <?php if ($u['role'] != 'admin'): ?>
                                        <form action="" method="POST" onsubmit="return confirm('Delete this user?')">
                                            <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                            <button type="submit" name="delete_user"
                                                style="padding:6px 14px; background:#fee2e2; color:#dc2626; border:none; border-radius:8px; cursor:pointer; font-size:13px; font-family:'DM Sans',sans-serif;">
                                                🗑 Delete
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span style="color:var(--text-gray); font-size:13px;">Protected</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>


        <!-- Add product tab -->
        <?php elseif ($active_tab == 'add_product'): ?>

            <div class="admin-header">
                <h1>➕ Add New Product</h1>
                <p>Fill in the details to add a product to the shop.</p>
            </div>

            <div class="admin-section" style="max-width:750px;">

                <form action="" method="POST">

                    <div class="admin-form-grid">

                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" placeholder="e.g. Lavender Candle" required>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" placeholder="e.g. Home Decor" required>
                        </div>

                        <div class="form-group">
                            <label>Price (Rs.)</label>
                            <input type="number" name="price" placeholder="e.g. 1200" required>
                        </div>

                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" name="stock" placeholder="e.g. 10" value="10" required>
                        </div>

                        <div class="form-group">
                            <label>Mood</label>
                            <select name="mood" required style="padding:12px 15px; border:1.5px solid var(--border); border-radius:12px; font-family:'DM Sans',sans-serif; font-size:15px; background:var(--light-bg); color:var(--text-dark); width:100%; outline:none;">
                                <option value="">-- Select Mood --</option>
                                <option value="happy">😄 Happy</option>
                                <option value="calm">😌 Calm</option>
                                <option value="sad">😢 Sad</option>
                                <option value="energetic">⚡ Energetic</option>
                                <option value="stressed">😣 Stressed</option>
                                <option value="adventurous">🌍 Adventurous</option>
                                <option value="focused">🎯 Focused</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Image URL</label>
                            <input type="text" name="image" placeholder="https://images.unsplash.com/...">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3" placeholder="Short product description..."
                            style="width:100%; padding:12px 15px; border:1.5px solid var(--border); border-radius:12px; font-family:'DM Sans',sans-serif; font-size:15px; background:var(--light-bg); color:var(--text-dark); resize:vertical; outline:none;"
                            required></textarea>
                    </div>

                    <button type="submit" name="add_product"
                        style="padding:14px 35px; background:linear-gradient(135deg,#7c3aed,#f43f5e); color:white; border:none; border-radius:14px; font-family:'DM Sans',sans-serif; font-size:16px; font-weight:700; cursor:pointer;">
                        ➕ Add Product
                    </button>

                </form>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
