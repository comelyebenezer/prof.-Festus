<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('academics.json'); ksort($all_items); $academics = array_slice($all_items, 0, 6, true); ?>
<section class="academics section-padding" id="academics">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Academics</span>
            <h2 class="section-title">Educational Background</h2>
            <p class="section-subtitle">
                A distinguished academic career built on a foundation of rigorous scholarship,
                research excellence, and commitment to knowledge dissemination.
            </p>
        </div>

        <div class="academics-grid stagger-children">
            <?php foreach ($academics as $id => $item): ?>
            <a href="single-academic.php?id=<?= htmlspecialchars($id) ?>" class="academic-card">
                <div class="academic-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-graduation-cap') ?>"></i></div>
                <div class="academic-info">
                    <h4><?= htmlspecialchars($item['institution'] ?? '') ?></h4>
                    <div class="academic-degree"><?= htmlspecialchars($item['degree'] ?? '') ?></div>
                    <div class="academic-year"><?= htmlspecialchars($item['year'] ?? '') ?></div>
                    <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="academics.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
