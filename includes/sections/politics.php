<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('politics.json'); ksort($all_items); $roles = array_slice($all_items, 0, 3, true); ?>
<section class="politics section-padding" id="politics">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Politics</span>
            <h2 class="section-title">Political Career</h2>
            <p class="section-subtitle">
                A dedicated public servant committed to good governance, policy reform, and
                community development through strategic political leadership.
            </p>
        </div>

        <div class="politics-grid stagger-children">
            <?php foreach ($roles as $id => $item): ?>
            <a href="single-politics.php?id=<?= htmlspecialchars($id) ?>" class="politics-card">
                <div class="pol-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-landmark') ?>"></i></div>
                <h3><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                <div class="pol-position"><?= htmlspecialchars($item['position'] ?? '') ?></div>
                <div class="pol-period"><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($item['period'] ?? '') ?></div>
                <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                <?php if (!empty($item['achievements'])): ?>
                <div class="pol-achievements">
                    <h4>Key Initiatives</h4>
                    <ul>
                        <?php foreach ($item['achievements'] as $achievement): ?>
                        <li><?= htmlspecialchars($achievement) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="politics.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
