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
            <h1>Maham Jahangir</h1>
            <div class="portfolio-title">UI Designer & Admin Developer</div>
            <div class="portfolio-contact">
                <span>📧 mahamjahangir56@gmail.com</span>
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
                I am a Computer Science student with a strong interest in UI/UX design
                and frontend development. I love making websites that are not only
                functional but also look beautiful. In this project I designed the
                entire visual identity of MoodMart and built the admin panel that
                manages the whole website.
            </p>
        </div>

       <!-- Quality Services -->
<div class="portfolio-section">
    <h2>My Quality Services</h2>

    <div class="contribution-list">

        <div class="contribution-item">
            <span class="contribution-icon">🎨</span>
            <div>
                <strong>UI/UX Design</strong>
                <p>Create modern, attractive, and user-friendly website interfaces with responsive layouts and smooth user experience.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">💻</span>
            <div>
                <strong>Frontend Development</strong>
                <p>Develop interactive web pages using HTML, CSS, JavaScript, and PHP with clean and organized design.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">⚙️</span>
            <div>
                <strong>Admin Panel Development</strong>
                <p>Build admin dashboards for managing products, users, and website data efficiently.</p>
            </div>
        </div>

        <div class="contribution-item">
            <span class="contribution-icon">🌙</span>
            <div>
                <strong>Interactive Features</strong>
                <p>Implement dynamic website features such as dark mode, animations, and notification systems for better user experience.</p>
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
                        <span>92%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 92%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>JavaScript</span>
                        <span>78%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 78%;"></div>
                    </div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-bar-label">
                        <span>PHP</span>
                        <span>74%</span>
                    </div>
                    <div class="skill-bar-bg">
                        <div class="skill-bar-fill" style="width: 74%;"></div>
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
                    <strong>FSc Pre-Engineering</strong>
                    <span>Emalah Foundation College, Rawalpindi</span>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>