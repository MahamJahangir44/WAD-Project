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
            <h1>Saqiba Yasmin</h1>
            <div class="portfolio-title">Frontend & Shop Developer</div>
            <div class="portfolio-contact">
                <span>📧 saqibayasmeen13@gmail.com</span>
                <span>📍 Rawalpindi, Pakistan</span>
                <span>🎓 BSCS — 4th Semester</span>
            </div>
        </div>
    </div>

    <div class="portfolio-body">

        <!-- About me -->
        <div class="portfolio-section">
            <h2>About Me</h2>
            <p>
                I am a Computer Science student who loves creating beautiful and
                user-friendly web pages. I enjoy combining HTML, CSS and PHP together
                to build pages that look great and work well. In this project I built
                the homepage and the shop page which are the most visited pages of MoodMart.
            </p>
        </div>

       <!-- Quality Services -->
<div class="portfolio-section">
    <h2>My Quality Services</h2>

    <div class="contribution-list">

        <div class="contribution-item">
            <span class="contribution-icon">🎨</span>
            <div>
                <strong>Frontend Development</strong>
                <p>Create clean, responsive, and visually appealing website layouts using HTML, CSS, and PHP.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🛍️</span>
            <div>
                <strong>E-commerce Interfaces</strong>
                <p>Develop modern shop pages, product cards, and user-friendly shopping experiences for online stores.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🧭</span>
            <div>
                <strong>Website Components</strong>
                <p>Build reusable website sections such as navigation bars, footers, hero sections, and feature areas.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🛒</span>
            <div>
                <strong>Dynamic Functionality</strong>
                <p>Implement interactive features like product filtering, add-to-cart systems, and dynamic content display.</p>
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
                        <span>HTML & CSS</span>
                        <span>90%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 90%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>PHP</span>
                        <span>75%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 75%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>JavaScript</span>
                        <span>65%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 65%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>MySQL</span>
                        <span>60%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 60%;"></div>
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
                    <span>Govt Associate College for Women, Rawalpindi</span>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>