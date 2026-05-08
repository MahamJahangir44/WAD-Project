<?php
session_start();
include 'includes/header.php';
?>

<div class="portfolio-page">

    <!-- Back button-->
    <div class="portfolio-back">
        <a href="about.php">← Back to Team</a>
    </div>

    <!-- Profile header-->
    <div class="portfolio-header">
        <div class="portfolio-avatar">👩‍💻</div>
        <div class="portfolio-header-info">
            <h1>Laraib Salam</h1>
            <div class="portfolio-title">Database & Authentication Developer</div>
            <div class="portfolio-contact">
                <span>📧 laraib.salam@gmail.com</span>
                <span>📍 Islamabad, Pakistan</span>
                <span>🎓 BSCS — 4th Semester</span>
            </div>
        </div>
    </div>

    <div class="portfolio-body">

        <!-- About me section -->
        <div class="portfolio-section">
            <h2>About Me</h2>
            <p>
                I am a Computer Science student passionate about backend development
                and database management. I love building secure systems and making sure
                data is stored properly. In this project, I was responsible for the entire
                database structure and the login/signup system.
            </p>
        </div>

       <!-- Quality Services -->
<div class="portfolio-section">
    <h2>My Quality Services</h2>

    <div class="contribution-list">

        <div class="contribution-item">
            <span class="contribution-icon">💻</span>
            <div>
                <strong>Web Development</strong>
                <p>Develop responsive and dynamic websites using PHP, MySQL, HTML, CSS, and JavaScript.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🗄️</span>
            <div>
                <strong>Database Design</strong>
                <p>Create structured MySQL databases with proper relationships, tables, and efficient data management.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🔐</span>
            <div>
                <strong>Authentication Systems</strong>
                <p>Build secure login and signup systems with validation, password hashing, and session management.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🎨</span>
            <div>
                <strong>Frontend Design</strong>
                <p>Create clean and user-friendly interfaces with responsive layouts and modern styling.</p>
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
                        <span>MySQL</span>
                        <span>85%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 85%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>PHP</span>
                        <span>80%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 80%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>HTML & CSS</span>
                        <span>70%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 70%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>JavaScript</span>
                        <span>55%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 55%;"></div>
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
                    <strong>FSc Pre-Medical</strong>
                    <span>Punjab College, DG Khan</span>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>