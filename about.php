<?php
session_start();
include 'includes/header.php';
?>

<!-- hero section-->
<div class="about-hero">
    <h1>About Us</h1>
    <p>The team behind the design and development of MoodMart</p>
</div>


<!-- team section -->
<div class="team-section">

    <h2>Our Team</h2>
    <p>Click on any member to view their portfolio.</p>

    <div class="team-grid">

        <!-- Member 1 -->
        <a href="portfolio1.php" class="member-card-link">
            <div class="member-card">
                <span class="member-avatar">👩‍💻</span>
                <div class="member-name">Laraib Salam</div>
                <div class="member-role">Database & Auth</div>
               
                <div class="view-portfolio-btn">View Portfolio →</div>
            </div>
        </a>

        <!-- Member 2 -->
        <a href="portfolio2.php" class="member-card-link">
            <div class="member-card">
                <span class="member-avatar">👩‍💻</span>
                <div class="member-name">Saqiba Yasmin</div>
                <div class="member-role">Homepage & Shop</div>
                
                <div class="view-portfolio-btn">View Portfolio →</div>
            </div>
        </a>

        <!-- Member 3-->
        <a href="portfolio3.php" class="member-card-link">
            <div class="member-card">
                <span class="member-avatar">👩‍💻</span>
                <div class="member-name">Sundas Sadia</div>
                <div class="member-role">Cart & Checkout</div>
               
                <div class="view-portfolio-btn">View Portfolio →</div>
            </div>
        </a>

        <!-- Member 4 -->
        <a href="portfolio4.php" class="member-card-link">
            <div class="member-card">
                <span class="member-avatar">👩‍💻</span>
                <div class="member-name">Maham Jahangir</div>
                <div class="member-role">Admin & Design</div>
               
                <div class="view-portfolio-btn">View Portfolio →</div>
            </div>
        </a>

    </div>

</div>




<?php include 'includes/footer.php'; ?>