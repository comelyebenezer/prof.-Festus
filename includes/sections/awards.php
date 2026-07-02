<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('awards.json'); ksort($all_items); $awards = array_slice($all_items, 0, 6, true); ?>
<section class="awards section-padding" id="awards">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Honors</span>
            <h2 class="section-title">Honors & Awards</h2>
            <p class="section-subtitle">
                Over 25 prestigious awards recognizing excellence in academia, real estate,
                politics, and community service.
            </p>
        </div>

        <div class="awards-grid stagger-children">
            <?php foreach ($awards as $id => $item): ?>
            <a href="single-award.php?id=<?= htmlspecialchars($id) ?>" class="award-card">
                <div class="award-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-trophy') ?>"></i></div>
                <div class="award-info">
                    <h4><?= htmlspecialchars($item['title'] ?? '') ?></h4>
                    <div class="award-org"><?= htmlspecialchars($item['org'] ?? '') ?></div>
                    <div class="award-year"><?= htmlspecialchars($item['year'] ?? '') ?></div>
                    <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="awards.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
