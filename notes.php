<?php
// ============================================================
// notes.php
// Displays all available study notes with category filtering.
// Students can view descriptions and download materials.
// ============================================================

$pageTitle = 'Study Notes';
require_once 'includes/auth_check.php';
require_once 'includes/header.php';
require_once 'config/database.php';

// Allowed categories (whitelist to prevent arbitrary SQL injection via filter)
$allowedCategories = ['all', 'government_exam', 'computer_course', 'shorthand'];

// Get active filter from query string; default to 'all'
$filter = $_GET['category'] ?? 'all';
if (!in_array($filter, $allowedCategories)) {
    $filter = 'all';
}

// Build query based on filter using prepared statements
if ($filter === 'all') {
    $stmt = $pdo->query("SELECT * FROM notes ORDER BY category, id");
} else {
    $stmt = $pdo->prepare("SELECT * FROM notes WHERE category = :category ORDER BY id");
    $stmt->execute([':category' => $filter]);
}

$notes = $stmt->fetchAll();

// Helper: return badge class and label for each category
function getCategoryInfo(string $category): array {
    $map = [
        'government_exam' => ['badge-govt',     '🏛️ Govt Exam'],
        'computer_course' => ['badge-computer', '💻 Computer'],
        'shorthand'       => ['badge-short',    '✍️ Shorthand'],
    ];
    return $map[$category] ?? ['badge-govt', 'General'];
}
?>

<div class="page-wrapper">

    <!-- ====== Page Title ====== -->
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <div>
            <h3 style="color:#1565C0; font-weight:700; margin:0;">📄 Study Notes</h3>
            <p style="color:#78909C; margin:0; font-size:0.9rem;">
                Browse and download notes across all course categories.
            </p>
        </div>
        <span style="background:#E3F2FD; color:#1565C0; padding:0.4rem 1rem; border-radius:20px; font-weight:600; font-size:0.88rem;">
            <?= count($notes) ?> note<?= count($notes) !== 1 ? 's' : '' ?> found
        </span>
    </div>

    <!-- ====== Filter Bar ====== -->
    <div class="filter-bar">
        <span style="font-weight:600; color:#37474F; font-size:0.9rem;">Filter by:</span>
        <a href="notes.php?category=all"
           class="filter-btn <?= $filter === 'all' ? 'active' : '' ?>">All Notes</a>
        <a href="notes.php?category=government_exam"
           class="filter-btn <?= $filter === 'government_exam' ? 'active' : '' ?>">🏛️ Govt Exam</a>
        <a href="notes.php?category=computer_course"
           class="filter-btn <?= $filter === 'computer_course' ? 'active' : '' ?>">💻 Computer</a>
        <a href="notes.php?category=shorthand"
           class="filter-btn <?= $filter === 'shorthand' ? 'active' : '' ?>">✍️ Shorthand</a>
    </div>

    <!-- ====== Notes Grid ====== -->
    <?php if (empty($notes)): ?>
        <div class="text-center py-5">
            <div style="font-size:3rem; margin-bottom:1rem;">📭</div>
            <h5 style="color:#546E7A;">No notes found for this category.</h5>
            <a href="notes.php" class="btn-download mt-3" style="display:inline-flex;">View All Notes</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($notes as $note):
                [$badgeClass, $badgeLabel] = getCategoryInfo($note['category']);
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="note-card">

                    <!-- Category Badge -->
                    <span class="note-category-badge <?= $badgeClass ?>">
                        <?= $badgeLabel ?>
                    </span>

                    <!-- Title -->
                    <h5><?= htmlspecialchars($note['title']) ?></h5>

                    <!-- Description -->
                    <p><?= htmlspecialchars($note['description']) ?></p>

                    <!-- Download / View Button -->
                    <?php if (!empty($note['file_path']) && $note['file_path'] !== '#'): ?>
                        <a href="<?= htmlspecialchars($note['file_path']) ?>"
                           class="btn-download"
                           target="_blank" rel="noopener"
                           download>
                            <i class="bi bi-download"></i> Download
                        </a>
                    <?php else: ?>
                        <!-- Placeholder when file is not yet uploaded -->
                        <span class="btn-download" style="opacity:0.55; cursor:default;">
                            <i class="bi bi-clock"></i> Coming Soon
                        </span>
                    <?php endif; ?>

                    <!-- Date -->
                    <div style="font-size:0.75rem; color:#B0BEC5; margin-top:0.75rem;">
                        <i class="bi bi-calendar3 me-1"></i>
                        Added: <?= date('d M Y', strtotime($note['created_at'])) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div><!-- /page-wrapper -->

<!-- ====== Footer ====== -->
<footer class="site-footer mt-4">
    <p>&copy; <?= date('Y') ?> Tanush Academy. All rights reserved.</p>
</footer>

<?php require_once 'includes/footer.php'; ?>
