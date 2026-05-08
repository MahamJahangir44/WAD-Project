<?php
session_start();
include 'includes/header.php';
?>

<div class="portfolio-page">

    <!-- Back button -->
    <div class="portfolio-back">
        <a href="about.php">← Back to Team</a>
    </div>

    <!-- Profile header -->
    <div class="portfolio-header">
        <div class="portfolio-avatar">👩‍💻</div>
        <div class="portfolio-header-info">
            <h1>Sundas Sadia</h1>
            <div class="portfolio-title">Cart & Checkout Developer</div>
            <div class="portfolio-contact">
                <span>📧 sundassadia025@gmail.com</span>
                <span>📍 Islamabad, Pakistan</span>
                <span>🎓 BSCS — 4th Semester</span>
            </div>
        </div>
    </div>

    <div class="portfolio-body">

        <!-- About me -->
        <div class="portfolio-section">
            <h2>About Me</h2>
            <p>
                I am a Computer Science student interested in backend logic and
                e-commerce systems. I enjoy solving problems step by step and
                building features that handle real data properly. In this project
                I built the cart and checkout system which is the heart of any
                e-commerce website.
            </p>
        </div>

       <!-- Quality Services -->
<div class="portfolio-section">
    <h2>My Quality Services</h2>

    <div class="contribution-list">

        <div class="contribution-item">
            <span class="contribution-icon">🛒</span>
            <div>
                <strong>Shopping Cart Systems</strong>
                <p>Develop dynamic cart systems with quantity management, item removal, and real-time updates.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">💳</span>
            <div>
                <strong>Checkout Functionality</strong>
                <p>Create secure checkout systems that process orders, manage order details, and handle cart clearing.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🗄️</span>
            <div>
                <strong>Database Integration</strong>
                <p>Connect PHP applications with MySQL databases using efficient queries and relational database concepts.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">✅</span>
            <div>
                <strong>Order Management</strong>
                <p>Build order confirmation and tracking features that improve the overall e-commerce user experience.</p>
            </div>
        </div>

    </div>
</div>

        <!-- Skills -->
        <div class="portfolio-section">
            <h2>Skills</h2>
            <div class="skills-grid">
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>PHP</span>
                        <span>82%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 82%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>MySQL</span>
                        <span>78%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 78%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>HTML & CSS</span>
                        <span>72%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 72%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>JavaScript</span>
                        <span>50%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 50%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education -->
        <div class="portfolio-section">
            <h2>Education</h2>
            <div class="edu-item">
                <div class="edu-year">2024 — Present</div>
                <div class="edu-info">
                    <strong>BS Computer Science</strong>
                    <span>Riphah International University, Islamabad</span>
                </div>
            </div>
            <div class="edu-item">
                <div class="edu-year">2022 — 2024</div>
                <div class="edu-info">
                    <strong>ICS</strong>
                    <span>Fauji Foundation College, Nowshera</span>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>