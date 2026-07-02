<?php
require 'includes/data_loader.php';
$all_items = load_data('blog.json');
$page_title = 'Blog';
$page_subtitle = 'Insights, articles, and thought leadership on accounting, finance, and business.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog - Prof. Festus Uwakhemen Asikhia">
    <meta name="author" content="Prof. Festus Uwakhemen Asikhia">
    <meta property="og:title" content="Prof. Festus Uwakhemen Asikhia - Blog">
    <title>Blog | Prof. Festus Uwakhemen Asikhia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- ===== Preloader ===== -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-logo">Prof. Festus A.</div>
            <div class="loader-bar"></div>
        </div>
    </div>

    <!-- ===== Navigation ===== -->
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
        <section class="blog section-padding" style="padding-top: 140px;">
            <div class="container">
                <div class="section-header reveal">
                    <a href="index.php" class="btn btn-outline" style="display: inline-block; margin-bottom: 16px;">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                    <span class="section-label">Blog</span>
                    <h2 class="section-title">All Posts</h2>
                    <p class="section-subtitle">Thoughts, insights, and perspectives on leadership, education, national development, and more.</p>
                </div>

                <div class="blog-grid stagger-children">
                    <?php foreach ($all_items as $post): ?>
                    <?php
                    $gradient = '';
                    $icon = '';
                    $bg_image = '';
                    switch ($post['id']) {
                        case 1: $gradient = 'linear-gradient(135deg, #1a365d, #2d6a9f)'; $icon = 'fa-graduation-cap'; break;
                        case 2: $gradient = 'linear-gradient(135deg, #7c3a1e, #c47a3a)'; $icon = 'fa-users'; break;
                        case 3: $gradient = 'linear-gradient(135deg, #1a4731, #2d8a5e)'; $icon = 'fa-building'; break;
                        case 4: $gradient = 'linear-gradient(135deg, #3a1a47, #7a2d8a)'; $icon = 'fa-handshake'; break;
                        case 5: $gradient = 'linear-gradient(135deg, #1a3a5c, #3a7abd)'; $icon = 'fa-chart-line'; break;
                        case 6: $gradient = 'linear-gradient(135deg, #4a1a1a, #8a2d2d)'; $icon = 'fa-scale-balanced'; break;
                        case 7: $gradient = 'linear-gradient(135deg, #1a4a2a, #2d8a4e)'; $icon = 'fa-leaf'; break;
                        case 8: $gradient = 'linear-gradient(135deg, #2a1a4a, #5a2d8a)'; $icon = 'fa-lightbulb'; break;
                        case 9: $bg_image = 'assets/images/blog-leadership-fct.jpg'; break;
                    }
                    ?>
                    <a href="single-blog.php?id=<?= $post['id'] ?>" class="blog-card">
                        <?php if ($post['id'] == 9): ?>
                        <div class="blog-img" style="background-image: url('<?= $bg_image ?>'); background-size: cover; background-position: center;">
                        </div>
                        <?php else: ?>
                        <div class="blog-img" style="background: <?= $gradient ?>;">
                            <i class="fas <?= $icon ?>"></i>
                        </div>
                        <?php endif; ?>
                        <div class="blog-content">
                            <h3><?= htmlspecialchars($post['title']) ?></h3>
                            <div class="blog-meta">
                                <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($post['date']) ?></span>
                                <span><i class="fas fa-tag"></i> <?= htmlspecialchars($post['category']) ?></span>
                            </div>
                            <p class="blog-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- ===== Footer ===== -->
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

    <!-- ===== Back to Top ===== -->
    <button class="back-to-top" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="assets/js/main.js"></script>
</body>
</html>
