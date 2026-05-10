<?php
session_start();
include 'includes/header.php';
?>

<!-- HERO SECTION -->
<div class="hero">
    <div class="hero-content">

        <div class="hero-badge">✨ Shop by how you feel</div>

        <h1>
            Your mood.<br>
            <span>Your shop.</span>
        </h1>

        <p>
            MoodMart picks products that match your vibe right now —
            calm, energetic, happy, or anywhere in between.
            Tell us how you feel, we'll do the rest.
        </p>

        <a href="#moods" class="hero-btn">Pick Your Mood 🎯</a>

        <!-- Stats -->
        <div class="hero-stats">
            <div class="stat">
                <div class="stat-number">28+</div>
                <div class="stat-label">Products</div>
            </div>
            <div class="stat">
                <div class="stat-number">7</div>
                <div class="stat-label">Moods</div>
            </div>
            <div class="stat">
                <div class="stat-number">100%</div>
                <div class="stat-label">Vibe-Checked</div>
            </div>
        </div>

    </div>
</div>


<!-- MOODS SECTION -->
<div id="moods" class="moods-section">

    <div class="section-badge">CHOOSE A MOOD</div>
    <h2 class="section-title">How are you feeling today?</h2>
    <p class="section-subtitle">Tap a mood and we'll curate the shop just for you.</p>

    <div class="moods-grid">

        <a href="shop.php?mood=happy" class="mood-card mood-happy">
            <div class="emoji">😄</div>
            <h3>Happy</h3>
        </a>

        <a href="shop.php?mood=calm" class="mood-card mood-calm">
            <div class="emoji">😌</div>
            <h3>Calm</h3>
        </a>

        <a href="shop.php?mood=sad" class="mood-card mood-sad">
            <div class="emoji">😢</div>
            <h3>Sad</h3>
        </a>

        <a href="shop.php?mood=energetic" class="mood-card mood-energetic">
            <div class="emoji">⚡</div>
            <h3>Energetic</h3>
        </a>

        <a href="shop.php?mood=stressed" class="mood-card mood-stressed">
            <div class="emoji">😣</div>
            <h3>Stressed</h3>
        </a>

        <a href="shop.php?mood=adventurous" class="mood-card mood-adventurous">
            <div class="emoji">🌍</div>
            <h3>Adventurous</h3>
        </a>

        <a href="shop.php?mood=focused" class="mood-card mood-focused">
            <div class="emoji">🎯</div>
            <h3>Focused</h3>
        </a>

    </div>

</div>


<!-- FEATURES SECTION -->
<div class="features-section">

    <div style="text-align:center;">
        <div class="section-badge">WHY MOODMART</div>
        <h2 class="section-title">Shopping, reimagined 🛍️</h2>
        <p class="section-subtitle">We make it easier to find what you actually need.</p>
    </div>

    <div class="features-grid">

        <div class="feature-card">
            <div class="feature-icon">🎭</div>
            <h3>Mood-Based Shopping</h3>
            <p>We match products to your current emotional state so everything feels right.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Fast & Easy</h3>
            <p>Browse, pick, checkout. We keep it simple so you can shop in minutes.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🚚</div>
            <h3>Quick Delivery</h3>
            <p>Get your mood-matched products delivered right to your doorstep.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>Secure Checkout</h3>
            <p>Your data is safe with us. Shop with confidence every time.</p>
        </div>

    </div>

</div>


<?php include 'includes/footer.php'; ?>
