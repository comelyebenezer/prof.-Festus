<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Dashboard' ?> | Admin - Prof. Festus Asikhia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <a href="dashboard.php" class="sidebar-brand">Festus CMS</a>
        </div>
        <nav class="sidebar-nav">
            <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="books.php" class="<?= strpos($_SERVER['PHP_SELF'], 'books') !== false ? 'active' : '' ?>">
                <i class="fas fa-book"></i> Books
            </a>
            <a href="blog.php" class="<?= strpos($_SERVER['PHP_SELF'], 'blog') !== false ? 'active' : '' ?>">
                <i class="fas fa-blog"></i> Blog
            </a>
            <a href="journal.php" class="<?= strpos($_SERVER['PHP_SELF'], 'journal') !== false ? 'active' : '' ?>">
                <i class="fas fa-scroll"></i> Journal
            </a>
            <a href="articles.php" class="<?= strpos($_SERVER['PHP_SELF'], 'articles') !== false ? 'active' : '' ?>">
                <i class="fas fa-newspaper"></i> Articles
            </a>
            <a href="awards.php" class="<?= strpos($_SERVER['PHP_SELF'], 'awards') !== false ? 'active' : '' ?>">
                <i class="fas fa-trophy"></i> Awards
            </a>
            <a href="certificates.php" class="<?= strpos($_SERVER['PHP_SELF'], 'certificates') !== false ? 'active' : '' ?>">
                <i class="fas fa-certificate"></i> Certificates
            </a>
            <a href="academics.php" class="<?= strpos($_SERVER['PHP_SELF'], 'academics') !== false ? 'active' : '' ?>">
                <i class="fas fa-graduation-cap"></i> Academics
            </a>
            <a href="real-estate.php" class="<?= strpos($_SERVER['PHP_SELF'], 'real-estate') !== false ? 'active' : '' ?>">
                <i class="fas fa-city"></i> Real Estate
            </a>
            <a href="politics.php" class="<?= strpos($_SERVER['PHP_SELF'], 'politics') !== false ? 'active' : '' ?>">
                <i class="fas fa-landmark"></i> Politics
            </a>
            <a href="businesses.php" class="<?= strpos($_SERVER['PHP_SELF'], 'businesses') !== false ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Businesses
            </a>
            <a href="timeline.php" class="<?= strpos($_SERVER['PHP_SELF'], 'timeline') !== false ? 'active' : '' ?>">
                <i class="fas fa-history"></i> Timeline
            </a>
            <a href="contacts.php" class="<?= strpos($_SERVER['PHP_SELF'], 'contacts') !== false ? 'active' : '' ?>">
                <i class="fas fa-envelope"></i> Messages
            </a>
            <hr>
            <a href="../index.php" target="_blank">
                <i class="fas fa-external-link-alt"></i> View Site
            </a>
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </aside>
    <main class="admin-main">
        <header class="admin-topbar">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-right">
                <span class="topbar-user"><i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></span>
            </div>
        </header>
        <div class="admin-content">
