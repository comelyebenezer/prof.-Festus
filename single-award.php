<?php
require 'includes/data_loader.php';
$all_items = load_data('awards.json');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$item = $all_items[$id] ?? $all_items[1];
$item['content'] = [$item['full_description']];
$award = $item;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($award['title']) ?> - Prof. Festus Uwakhemen Asikhia">
    <meta name="author" content="Prof. Festus Uwakhemen Asikhia">
    <title><?= htmlspecialchars($award['title']) ?> | Prof. Festus Uwakhemen Asikhia</title>
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
                <a href="books.php">Books</a>
                <a href="index.php#real-estate">Real Estate</a>
                <a href="awards.php">Awards</a>
                <a href="blog.php">Blog</a>
                <a href="journal.php">Journal</a>
                <a href="articles.php">Articles</a>
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
        <section class="awards section-padding" id="awards" style="padding-top: 140px;">
            <div class="container">
                <div class="single-blog-header reveal">
                    <a href="awards.php" class="btn btn-outline" style="margin-bottom: 24px; display: inline-block;">
                        <i class="fas fa-arrow-left"></i> Back to Awards
                    </a>
                    <div class="blog-meta" style="justify-content: center;">
                        <span><i class="fas fa-calendar"></i> <?= $award['year'] ?></span>
                        <span><i class="fas fa-building"></i> <?= $award['org'] ?></span>
                    </div>
                    <h1><?= $award['title'] ?></h1>
                </div>
                <div class="single-blog-image" style="background: linear-gradient(135deg, #1a365d, #2d6a9f); font-size: 5rem;">
                    <i class="fas <?= $award['icon'] ?>"></i>
                </div>
                <div class="single-blog-content reveal">
                    <?php foreach ($award['content'] as $paragraph): ?>
                        <p><?= $paragraph ?></p>
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
                    <p>...</p>
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
                        <li><a href="books.php">Books</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="journal.php">Journal</a></li>
                        <li><a href="articles.php">Articles</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
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
