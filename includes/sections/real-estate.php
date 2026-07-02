<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('real-estate.json'); ksort($all_items); $projects = array_slice($all_items, 0, 3, true); ?>
<section class="real-estate section-padding" id="real-estate">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Real Estate</span>
            <h2 class="section-title">Property Development</h2>
            <p class="section-subtitle">
                Through Festus Asikhia Realty, we transform communities with innovative,
                sustainable, and world-class property development projects across Nigeria.
            </p>
        </div>

        <div class="estate-grid stagger-children">
            <?php foreach ($projects as $id => $item): ?>
            <a href="single-real-estate.php?id=<?= htmlspecialchars($id) ?>" class="estate-card">
                <div class="estate-image">
                    <i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-city') ?>"></i>
                    <span class="estate-status"><?= htmlspecialchars($item['status'] ?? '') ?></span>
                </div>
                <div class="estate-card-body">
                    <h3><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                    <div class="estate-company"><?= htmlspecialchars($item['company'] ?? 'Festus Asikhia Realty') ?></div>
                    <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                    <div class="estate-details">
                        <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($item['location'] ?? '') ?></span>
                        <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($item['year'] ?? '') ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="real-estate.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
