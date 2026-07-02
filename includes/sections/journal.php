<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('journal.json'); ksort($all_items); $journals = array_slice($all_items, 0, 3, true); ?>
<section class="awards section-padding" id="journal">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Journal</span>
            <h2 class="section-title">Academic Journal</h2>
            <p class="section-subtitle">
                Peer-reviewed research publications and scholarly articles contributing to knowledge
                in organizational leadership, educational management, and policy development.
            </p>
        </div>

        <div class="awards-grid stagger-children">
            <?php foreach ($journals as $id => $item): ?>
            <a href="single-journal.php?id=<?= htmlspecialchars($id) ?>" class="award-card">
                <div class="award-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-scroll') ?>"></i></div>
                <div class="award-info">
                    <h4><?= htmlspecialchars($item['title'] ?? '') ?></h4>
                    <div class="award-org"><?= htmlspecialchars($item['journal'] ?? '') ?></div>
                    <div class="award-year"><?= htmlspecialchars($item['volume'] ?? '') ?></div>
                    <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="journal-more-btn" style="text-align:center;margin-top:48px;">
            <a href="journal.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
