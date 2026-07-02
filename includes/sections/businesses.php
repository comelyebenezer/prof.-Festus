<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('businesses.json'); ksort($all_items); $businesses = array_slice($all_items, 0, 3, true); ?>
<section class="businesses section-padding" id="businesses">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Ventures</span>
            <h2 class="section-title">Business Enterprises</h2>
            <p class="section-subtitle">
                A diversified portfolio of successful business ventures spanning real estate,
                education, agriculture, consulting, and hospitality.
            </p>
        </div>

        <div class="businesses-grid stagger-children">
            <?php foreach ($businesses as $id => $item): ?>
            <a href="single-business.php?id=<?= htmlspecialchars($id) ?>" class="business-card">
                <div class="biz-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-building') ?>"></i></div>
                <h3><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                <div class="biz-role"><?= htmlspecialchars($item['role'] ?? '') ?></div>
                <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                <span class="biz-industry"><?= htmlspecialchars($item['industry'] ?? '') ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="businesses.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
