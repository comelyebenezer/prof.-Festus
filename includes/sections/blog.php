<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('blog.json'); $blog_posts = array_slice($all_items, 0, 4); ?>
<section class="blog section-padding" id="blog">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Blog</span>
            <h2 class="section-title">From My Blog</h2>
            <p class="section-subtitle">
                Thoughts, insights, and perspectives on leadership, education, national development,
                and the intersection of academia, business, and public service.
            </p>
        </div>

        <div class="blog-grid stagger-children">
            <?php foreach ($blog_posts as $id => $item): ?>
            <a href="single-blog.php?id=<?= htmlspecialchars($id) ?>" class="blog-card">
                <div class="blog-img" style="background: linear-gradient(135deg, <?= htmlspecialchars($item['gradient_start'] ?? '#1a365d') ?>, <?= htmlspecialchars($item['gradient_end'] ?? '#2d6a9f') ?>);">
                    <i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-newspaper') ?>"></i>
                </div>
                <div class="blog-content">
                    <h3><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                    <div class="blog-meta">
                        <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($item['date'] ?? '') ?></span>
                        <span><i class="fas fa-tag"></i> <?= htmlspecialchars($item['category'] ?? '') ?></span>
                    </div>
                    <p class="blog-excerpt"><?= htmlspecialchars($item['excerpt'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="blog.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
