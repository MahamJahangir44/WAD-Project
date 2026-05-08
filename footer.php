<footer class="footer">
    <div class="footer-container">

        <div class="footer-section">
            <h2>MoodMart 🛍️</h2>
            <p>Shopping that matches your mood. Simple, fun, and made just for you.</p>
        </div>

        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="index.php#moods">Moods</a>
            <a href="about.php">About</a>
        </div>

        <div class="footer-section">
            <h3>Account</h3>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="cart.php">My Cart</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="signup.php">Sign Up</a>
            <?php endif; ?>
        </div>

        <div class="footer-section">
            <h3>Contact</h3>
            <p>📧 moodmart@email.com</p>
            <p>📞 0300-1234567</p>
            <p>📍 Islamabad, Pakistan</p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2026 MoodMart. All rights reserved. Made with 💜</p>
    </div>
</footer>

<!-- JS -->
<script src="js/script.js"></script>

</body>
</html>
