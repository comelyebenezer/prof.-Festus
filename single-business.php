<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Business Enterprise Detail - Prof. Festus Uwakhemen Asikhia">
    <meta name="author" content="Prof. Festus Uwakhemen Asikhia">
    <?php
    require 'includes/data_loader.php';
    $all_items = load_data('businesses.json');
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
    $item = $all_items[$id] ?? $all_items[1];
    ?>
    <title><?= htmlspecialchars($item['title']) ?> | Prof. Festus Uwakhemen Asikhia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand">Prof. <span>Festus</span> A.</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="index.php#about">About</a>
                <a href="businesses.php" class="active">Businesses</a>
                <a href="politics.php">Politics</a>
                <a href="books.php">Books</a>
                <a href="blog.php">Blog</a>
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
        <section class="section-padding" style="padding-top: 140px;">
            <div class="container">
                <div class="section-header reveal" style="text-align: left; max-width: 100%;">
                    <a href="businesses.php" class="btn btn-outline" style="display: inline-block; margin-bottom: 16px;">
                        <i class="fas fa-arrow-left"></i> Back to Businesses
                    </a>
                    <span class="section-label"><?= htmlspecialchars($item['industry']) ?></span>
                    <h2 class="section-title" style="font-size: 2rem;"><?= htmlspecialchars($item['title']) ?></h2>
                </div>
                <div class="single-content stagger-children" style="max-width: 800px; margin: 0 auto;">
                    <div class="single-meta" style="display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 32px;">
                        <span style="background: rgba(212,168,67,0.1); color: var(--gold); padding: 6px 16px; border-radius: 20px; font-size: 0.85rem;">
                            <i class="fas fa-user-tie"></i> <?= htmlspecialchars($item['role']) ?>
                        </span>
                        <span style="background: rgba(212,168,67,0.1); color: var(--gold); padding: 6px 16px; border-radius: 20px; font-size: 0.85rem;">
                            <i class="fas fa-tag"></i> <?= htmlspecialchars($item['industry']) ?>
                        </span>
                    </div>
                    <p style="font-size: 1.05rem; line-height: 1.8; color: var(--text-light); margin-bottom: 24px; text-align: justify;">
                        <?= htmlspecialchars($item['description']) ?>
                    </p>
                    <p style="font-size: 1rem; line-height: 1.8; color: var(--text-muted); margin-bottom: 32px; text-align: justify;">
                        <?= htmlspecialchars($item['full_description']) ?>
                    </p>
                    <h3 style="font-size: 1.2rem; margin-bottom: 16px; color: var(--gold);">Key Highlights</h3>
                    <ul style="list-style: none; padding: 0; margin-bottom: 32px;">
                        <?php foreach ($item['highlights'] as $highlight): ?>
                        <li style="padding: 10px 0; border-bottom: 1px solid var(--card-border); display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-check-circle" style="color: var(--gold); margin-top: 3px;"></i>
                            <span style="color: var(--text-muted);"><?= htmlspecialchars($highlight) ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="businesses.php" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to All Businesses
                    </a>
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
                        <li><a href="politics.php">Politics</a></li>
                        <li><a href="businesses.php">Businesses</a></li>
                        <li><a href="books.php">Books</a></li>
                        <li><a href="blog.php">Blog</a></li>
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
