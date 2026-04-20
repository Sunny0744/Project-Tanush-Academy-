<?php
// ============================================================
// dashboard.php
// Main dashboard shown to logged-in students.
// Displays sections for Govt Exams, Computer Courses, Shorthand.
// ============================================================

$pageTitle = 'Tanush Academy Dashboard';
require_once 'includes/auth_check.php';
require_once 'includes/header.php';
require_once 'config/database.php';

// Fetch note counts per category for stat display
$stmt = $pdo->query("SELECT category, COUNT(*) as total FROM notes GROUP BY category");
$noteCounts = [];
while ($row = $stmt->fetch()) {
    $noteCounts[$row['category']] = $row['total'];
}

// Get initials for avatar
$initials = strtoupper(substr($_SESSION['user_name'], 0, 1));
?>

<div class="page-wrapper">

    <!-- ====== Welcome Banner ====== -->
    <div class="welcome-banner">
        <div class="avatar"><?= $initials ?></div>
        <div>
            <h4>Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h4>
            <p>Tanush Academy Dashboard &mdash; Choose a section below to start studying.</p>
        </div>
    </div>

    <!-- ====== Quick Stats ====== -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="info-card text-center" style="padding:1.2rem;">
                <div style="font-size:2rem; margin-bottom:0.4rem;">🏛️</div>
                <div style="font-size:1.6rem; font-weight:700; color:#1565C0;">
                    <?= $noteCounts['government_exam'] ?? 0 ?>
                </div>
                <div style="font-size:0.8rem; color:#78909C; font-weight:600;">Govt Exam Notes</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="info-card text-center" style="padding:1.2rem;">
                <div style="font-size:2rem; margin-bottom:0.4rem;">💻</div>
                <div style="font-size:1.6rem; font-weight:700; color:#1565C0;">
                    <?= $noteCounts['computer_course'] ?? 0 ?>
                </div>
                <div style="font-size:0.8rem; color:#78909C; font-weight:600;">Computer Notes</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="info-card text-center" style="padding:1.2rem;">
                <div style="font-size:2rem; margin-bottom:0.4rem;">✍️</div>
                <div style="font-size:1.6rem; font-weight:700; color:#1565C0;">
                    <?= $noteCounts['shorthand'] ?? 0 ?>
                </div>
                <div style="font-size:0.8rem; color:#78909C; font-weight:600;">Shorthand Notes</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="info-card text-center" style="padding:1.2rem;">
                <div style="font-size:2rem; margin-bottom:0.4rem;">📚</div>
                <div style="font-size:1.6rem; font-weight:700; color:#1565C0;">
                    <?= array_sum($noteCounts) ?>
                </div>
                <div style="font-size:0.8rem; color:#78909C; font-weight:600;">Total Materials</div>
            </div>
        </div>
    </div>

    <!-- ====== Section 1: Government Exam Preparation ====== -->
    <h2 class="section-heading">🏛️ Government Exam Preparation</h2>
    <div class="row g-4 mb-5">

        <!-- UPSC -->
        <div class="col-md-6 col-lg-3">
            <div class="info-card">
                <div class="card-icon icon-blue">🇮🇳</div>
                <h5>UPSC Civil Services</h5>
                <p>Polity, History, Geography, Economy, Current Affairs for IAS/IPS/IFS preparation.</p>
                <div class="mt-3">
                    <span class="topic-tag">Polity</span>
                    <span class="topic-tag">History</span>
                    <span class="topic-tag">Geography</span>
                    <span class="topic-tag">Economy</span>
                </div>
            </div>
        </div>

        <!-- SSC -->
        <div class="col-md-6 col-lg-3">
            <div class="info-card">
                <div class="card-icon icon-green">📝</div>
                <h5>SSC Exams</h5>
                <p>Complete preparation material for SSC CGL, CHSL, MTS, GD Constable examinations.</p>
                <div class="mt-3">
                    <span class="topic-tag">General Knowledge</span>
                    <span class="topic-tag">Math</span>
                    <span class="topic-tag">English</span>
                    <span class="topic-tag">Reasoning</span>
                </div>
            </div>
        </div>

        <!-- Banking -->
        <div class="col-md-6 col-lg-3">
            <div class="info-card">
                <div class="card-icon icon-orange">🏦</div>
                <h5>Banking Exams</h5>
                <p>IBPS PO, IBPS Clerk, SBI PO, RRB PO study material with sectional mock practice.</p>
                <div class="mt-3">
                    <span class="topic-tag">Awareness</span>
                    <span class="topic-tag">Reasoning</span>
                    <span class="topic-tag">Quant</span>
                    <span class="topic-tag">English</span>
                </div>
            </div>
        </div>

        <!-- Railway -->
        <div class="col-md-6 col-lg-3">
            <div class="info-card">
                <div class="card-icon icon-red">🚂</div>
                <h5>Railway Exams</h5>
                <p>RRB NTPC, Group D, ALP, JE preparation with previous year question analysis.</p>
                <div class="mt-3">
                    <span class="topic-tag">GK</span>
                    <span class="topic-tag">Science</span>
                    <span class="topic-tag">Math</span>
                    <span class="topic-tag">Reasoning</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Section 2: Computer Courses ====== -->
    <h2 class="section-heading">💻 Computer Courses</h2>
    <div class="row g-4 mb-5">

        <!-- Basic Computer -->
        <div class="col-md-6 col-lg-4">
            <div class="info-card">
                <div class="card-icon icon-blue">🖥️</div>
                <h5>Basic Computer</h5>
                <p>Fundamentals of computers, operating systems, internet basics, and file management for complete beginners.</p>
                <div class="mt-3">
                    <span class="topic-tag">Hardware</span>
                    <span class="topic-tag">Software</span>
                    <span class="topic-tag">OS</span>
                    <span class="topic-tag">Internet</span>
                </div>
            </div>
        </div>

        <!-- MS Office -->
        <div class="col-md-6 col-lg-4">
            <div class="info-card">
                <div class="card-icon icon-green">📊</div>
                <h5>MS Office Suite</h5>
                <p>Practical training in MS Word, Excel, PowerPoint, and Access for professional and exam use.</p>
                <div class="mt-3">
                    <span class="topic-tag">MS Word</span>
                    <span class="topic-tag">MS Excel</span>
                    <span class="topic-tag">PowerPoint</span>
                    <span class="topic-tag">Access</span>
                </div>
            </div>
        </div>

        <!-- Web Development -->
        <div class="col-md-6 col-lg-4">
            <div class="info-card">
                <div class="card-icon icon-orange">🌐</div>
                <h5>Web Development</h5>
                <p>Learn to build websites from scratch with HTML5, CSS3, and JavaScript fundamentals.</p>
                <div class="mt-3">
                    <span class="topic-tag">HTML5</span>
                    <span class="topic-tag">CSS3</span>
                    <span class="topic-tag">JavaScript</span>
                    <span class="topic-tag">Responsive</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Section 3: Shorthand Practice ====== -->
    <h2 class="section-heading">✍️ Shorthand Practice</h2>
    <div class="row g-4 mb-5">

        <!-- Pitman Shorthand -->
        <div class="col-md-6 col-lg-4">
            <div class="info-card">
                <div class="card-icon icon-blue">📖</div>
                <h5>Pitman Shorthand Basics</h5>
                <p>Learn the Pitman shorthand system from stroke formation to basic word outlines and vowel signs.</p>
                <div class="mt-3">
                    <span class="topic-tag">Strokes</span>
                    <span class="topic-tag">Vowels</span>
                    <span class="topic-tag">Consonants</span>
                    <span class="topic-tag">Outlines</span>
                </div>
            </div>
        </div>

        <!-- Speed Building -->
        <div class="col-md-6 col-lg-4">
            <div class="info-card">
                <div class="card-icon icon-green">⚡</div>
                <h5>Speed Building</h5>
                <p>Structured dictation exercises designed to progressively increase your shorthand speed from 40 to 100+ WPM.</p>
                <div class="mt-3">
                    <span class="topic-tag">40 WPM</span>
                    <span class="topic-tag">60 WPM</span>
                    <span class="topic-tag">80 WPM</span>
                    <span class="topic-tag">100 WPM</span>
                </div>
            </div>
        </div>

        <!-- Practice Passages -->
        <div class="col-md-6 col-lg-4">
            <div class="info-card">
                <div class="card-icon icon-orange">📋</div>
                <h5>Practice Materials</h5>
                <p>Common phrases, abbreviations, and full practice passages for court reporting and office examinations.</p>
                <div class="mt-3">
                    <span class="topic-tag">Phrases</span>
                    <span class="topic-tag">Abbreviations</span>
                    <span class="topic-tag">Passages</span>
                    <span class="topic-tag">Exam Prep</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Quick Access: Study Notes ====== -->
    <div class="info-card" style="background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); border: none;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h5 style="margin-bottom:0.4rem;">📄 Access Your Study Notes</h5>
                <p style="margin:0; color:#546E7A;">Download notes across all categories from the Study Notes page.</p>
            </div>
            <a href="notes.php" class="btn-download" style="padding:0.65rem 1.5rem; font-size:0.95rem;">
                <i class="bi bi-journal-text"></i> Browse Notes
            </a>
        </div>
    </div>

</div><!-- /page-wrapper -->

<!-- ====== Footer ====== -->
<footer class="site-footer mt-4">
    <p>&copy; <?= date('Y') ?> Tanush Academy. All rights reserved.</p>
</footer>

<?php require_once 'includes/footer.php'; ?>
