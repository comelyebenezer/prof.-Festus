<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Dashboard';

$stats = [
    'books' => count(read_json('books.json')),
    'blog' => count(read_json('blog.json')),
    'journal' => count(read_json('journal.json')),
    'articles' => count(read_json('articles.json')),
    'awards' => count(read_json('awards.json')),
    'certificates' => count(read_json('certificates.json')),
    'academics' => count(read_json('academics.json')),
    'real_estate' => count(read_json('real-estate.json')),
    'politics' => count(read_json('politics.json')),
    'businesses' => count(read_json('businesses.json')),
    'timeline' => count(read_json('timeline.json')),
    'contacts' => count(read_json('contacts.json')),
];

require 'includes/header.php';
?>
<div class="page-header">
    <h1>Dashboard</h1>
    <a href="../index.php" class="btn btn-secondary" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-book"></i></div>
        <div class="stat-info">
            <h3><?= $stats['books'] ?></h3>
            <p>Books & Publications</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-blog"></i></div>
        <div class="stat-info">
            <h3><?= $stats['blog'] ?></h3>
            <p>Blog Posts</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-scroll"></i></div>
        <div class="stat-info">
            <h3><?= $stats['journal'] ?></h3>
            <p>Journal Entries</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-newspaper"></i></div>
        <div class="stat-info">
            <h3><?= $stats['articles'] ?></h3>
            <p>Articles</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-trophy"></i></div>
        <div class="stat-info">
            <h3><?= $stats['awards'] ?></h3>
            <p>Awards</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-certificate"></i></div>
        <div class="stat-info">
            <h3><?= $stats['certificates'] ?></h3>
            <p>Certificates</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-graduation-cap"></i></div>
        <div class="stat-info">
            <h3><?= $stats['academics'] ?></h3>
            <p>Academics</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-city"></i></div>
        <div class="stat-info">
            <h3><?= $stats['real_estate'] ?></h3>
            <p>Real Estate Projects</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-landmark"></i></div>
        <div class="stat-info">
            <h3><?= $stats['politics'] ?></h3>
            <p>Political Roles</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-chart-line"></i></div>
        <div class="stat-info">
            <h3><?= $stats['businesses'] ?></h3>
            <p>Businesses</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-history"></i></div>
        <div class="stat-info">
            <h3><?= $stats['timeline'] ?></h3>
            <p>Timeline Events</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <h3><?= $stats['contacts'] ?></h3>
            <p>Contact Messages</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Quick Actions</h2>
    </div>
    <div class="card-body" style="display:flex;flex-wrap:wrap;gap:12px;">
        <a href="books.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Manage Books</a>
        <a href="blog.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Manage Blog</a>
        <a href="journal.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Manage Journal</a>
        <a href="articles.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Manage Articles</a>
        <a href="awards.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Manage Awards</a>
        <a href="contacts.php" class="btn btn-secondary btn-sm"><i class="fas fa-envelope"></i> View Messages</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Admin Info</h2>
    </div>
    <div class="card-body">
        <p class="text-muted">Default login: <strong>admin</strong> / <strong>admin123</strong></p>
        <p class="text-muted">All data is stored in JSON files under <code>admin/data/</code>. No database required.</p>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
