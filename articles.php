<?php
require 'includes/data_loader.php';
$all_items = load_data('articles.json');
$page_title = 'Articles & Media Features';
$page_subtitle = 'Media appearances, newspaper features, and industry contributions.';
ksort($all_items);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Articles - Prof. Festus Uwakhemen Asikhia">
    <meta name="author" content="Prof. Festus Uwakhemen Asikhia">
    <meta property="og:title" content="Prof. Festus Uwakhemen Asikhia - Articles">
    <title>Articles | Prof. Festus Uwakhemen Asikhia</title>
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
                <a href="blog.php">Blog</a>
                <a href="articles.php" class="active">Articles</a>
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
        <section class="real-estate section-padding" id="articles" style="padding-top: 140px;">
            <div class="container">
                <div class="section-header reveal">
                    <a href="index.php" class="btn btn-outline" style="display: inline-block; margin-bottom: 16px;">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                    <span class="section-label">Articles</span>
                    <h2 class="section-title">All Articles</h2>
                    <p class="section-subtitle">Published articles, opinion pieces, and thought leadership contributions to national newspapers, magazines, and professional publications.</p>
                </div>

                <div class="estate-grid stagger-children">
                    <?php foreach ($all_items as $key => $article): ?>
                    <a href="single-article.php?id=<?= $key ?>" class="estate-card">
                        <div class="estate-image" style="height: 160px; font-size: 2rem;">
                            <i class="fas <?= $article['icon'] ?>"></i>
                            <?php if (!empty($article['featured'])): ?>
                            <span class="estate-status" style="background: rgba(212,168,67,0.15); color: var(--gold); border-color: rgba(212,168,67,0.2);">Featured</span>
                            <?php endif; ?>
                        </div>
                        <div class="estate-card-body">
                            <h3><?= htmlspecialchars($article['title']) ?></h3>
                            <div class="estate-company"><?= htmlspecialchars($article['publication']) ?></div>
                            <p><?= htmlspecialchars($article['description']) ?></p>
                            <div class="estate-details">
                                <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($article['date']) ?></span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
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
                        <li><a href="index.php#real-estate">Real Estate</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="articles.php">Articles</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Expertise</h4>
                    <ul class="footer-links">
                        <li><a href="index.php#academics">Academics</a></li>
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
