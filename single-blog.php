<?php
require 'includes/data_loader.php';
$all_items = load_data('blog.json');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$item = null;
foreach ($all_items as $v) {
    if (($v['id'] ?? 0) === $id) { $item = $v; break; }
}
if (!$item) $item = $all_items[0] ?? [];

$category_styles = [
    'Education'    => ['gradient' => 'linear-gradient(135deg, #1a365d, #2d6a9f)', 'icon' => 'fa-graduation-cap'],
    'Leadership'   => ['gradient' => 'linear-gradient(135deg, #7c3a1e, #c47a3a)', 'icon' => 'fa-users'],
    'Real Estate'  => ['gradient' => 'linear-gradient(135deg, #1a4731, #2d8a5e)', 'icon' => 'fa-building'],
    'Politics'     => ['gradient' => 'linear-gradient(135deg, #3a1a47, #7a2d8a)', 'icon' => 'fa-handshake'],
    'Business'     => ['gradient' => 'linear-gradient(135deg, #1a3a5c, #3a7abd)', 'icon' => 'fa-chart-line'],
    'Governance'   => ['gradient' => 'linear-gradient(135deg, #4a1a1a, #8a2d2d)', 'icon' => 'fa-scale-balanced'],
    'Development'  => ['gradient' => 'linear-gradient(135deg, #1a4a2a, #2d8a4e)', 'icon' => 'fa-leaf'],
    'Academia'     => ['gradient' => 'linear-gradient(135deg, #2a1a4a, #5a2d8a)', 'icon' => 'fa-lightbulb'],
];
$cat = $item['category'] ?? '';
$style = $category_styles[$cat] ?? ['gradient' => 'linear-gradient(135deg, #1a365d, #2d6a9f)', 'icon' => 'fa-graduation-cap'];
$item['gradient'] = $style['gradient'];
$item['icon'] = $style['icon'];
$item['source_url'] = $item['source_url'] ?? '';
$item['has_source'] = !empty($item['source_url']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($item['title']) ?> - Prof. Festus Uwakhemen Asikhia">
    <meta name="author" content="Prof. Festus Uwakhemen Asikhia">
    <meta property="og:title" content="<?= htmlspecialchars($item['title']) ?>">
    <title><?= htmlspecialchars($item['title']) ?> | Prof. Festus Uwakhemen Asikhia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-logo">Prof. Festus A.</div>
            <div class="loader-bar"></div>
        </div>
    </div>

    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand">Prof. <span>Festus</span> A.</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="index.php#about">About</a>
                <a href="index.php#books">Books</a>
                <a href="index.php#real-estate">Real Estate</a>
                <a href="index.php#awards">Awards</a>
                <a href="blog.php" class="active">Blog</a>
                <a href="index.php#journal">Journal</a>
                <a href="index.php#articles">Articles</a>
                <a href="index.php#contact">Contact</a>
            </div>
            <div class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <main>
        <article class="single-blog section-padding" style="padding-top: 140px;">
            <div class="container">
                <div class="single-blog-header reveal">
                    <a href="blog.php" class="btn btn-outline" style="margin-bottom: 24px; display: inline-block;">
                        <i class="fas fa-arrow-left"></i> Back to Blog
                    </a>
                    <div class="blog-meta" style="justify-content: center;">
                        <span><i class="fas fa-calendar"></i> <?= $item['date'] ?></span>
                        <span><i class="fas fa-tag"></i> <?= $item['category'] ?></span>
                    </div>
                    <h1><?= $item['title'] ?></h1>
                </div>

                <?php if ($item['has_source']): ?>
                <div class="single-blog-image" style="background-image: url('assets/images/blog-leadership-fct.jpg'); background-size: cover; background-position: center;"></div>
                <?php else: ?>
                <div class="single-blog-image" style="background: <?= $item['gradient'] ?>;">
                    <i class="fas <?= $item['icon'] ?>"></i>
                </div>
                <?php endif; ?>

                <div class="single-blog-content reveal">
                    <?php foreach ($item['content'] as $paragraph): ?>
                        <p><?= $paragraph ?></p>
                    <?php endforeach; ?>
                    <?php if ($item['has_source']): ?>
                    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid var(--card-border);">
                        <a href="<?= htmlspecialchars($item['source_url']) ?>" target="_blank" rel="noopener" class="btn btn-outline">
                            <i class="fas fa-external-link-alt"></i> Read original article on <?= htmlspecialchars($item['source']) ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </main>

    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>Prof. <span>Festus</span> A.</h3>
                    <p>A distinguished academic, visionary real estate developer, seasoned politician, and serial entrepreneur committed to excellence and transformative impact.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#about">About</a></li>
                        <li><a href="index.php#books">Books</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="index.php#journal">Journal</a></li>
                        <li><a href="index.php#articles">Articles</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Expertise</h4>
                    <ul class="footer-links">
                        <li><a href="index.php#academics">Academics</a></li>
                        <li><a href="index.php#real-estate">Real Estate</a></li>
                        <li><a href="index.php#politics">Politics</a></li>
                        <li><a href="index.php#businesses">Business</a></li>
                        <li><a href="index.php#awards">Awards</a></li>
                        <li><a href="index.php#timeline">Timeline</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Contact</h4>
                    <ul class="footer-links">
                        <li><a href="mailto:drfestusasikhia@gmail.com"><i class="fas fa-envelope"></i> Email</a></li>
                        <li><a href="tel:08091769651"><i class="fas fa-phone"></i> Call</a></li>
                        <li><a href="index.php#contact"><i class="fas fa-comment"></i> Message</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; 2026 Prof. Festus Uwakhemen Asikhia. All Rights Reserved.</span>
                <span>Designed with <i class="fas fa-heart" style="color: var(--gold);"></i> for excellence</span>
            </div>
        </div>
    </footer>

    <button class="back-to-top" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="assets/js/main.js"></script>
</body>
</html>
