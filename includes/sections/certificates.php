<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('certificates.json'); $certificates = array_slice($all_items, 0, 8); ?>
<section class="certificates section-padding" id="certificates">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Professional Certificates</span>
            <h2 class="section-title">Certifications</h2>
        </div>

        <div class="certificates-grid stagger-children">
            <?php foreach ($certificates as $item): ?>
            <div class="certificate-card">
                <div class="cert-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-certificate') ?>"></i></div>
                <h5><?= htmlspecialchars($item['title'] ?? '') ?></h5>
                <span><?= htmlspecialchars($item['institution'] ?? '') ?></span>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="certificates.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
