<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('articles.json'); ksort($all_items); $articles = array_slice($all_items, 0, 3, true); ?>
<section class="real-estate section-padding" id="articles">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Articles</span>
            <h2 class="section-title">Featured Articles</h2>
            <p class="section-subtitle">
                Published articles, opinion pieces, and thought leadership contributions to
                national newspapers, magazines, and professional publications.
            </p>
        </div>

        <div class="estate-grid stagger-children">
            <?php foreach ($articles as $id => $item): ?>
            <a href="single-article.php?id=<?= htmlspecialchars($id) ?>" class="estate-card">
                <div class="estate-image" style="height: 160px; font-size: 2rem;">
                    <i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-newspaper') ?>"></i>
                    <?php if (!empty($item['badge'])): ?>
                    <span class="estate-status" style="background: rgba(212,168,67,0.15); color: var(--gold); border-color: rgba(212,168,67,0.2);"><?= htmlspecialchars($item['badge']) ?></span>
                    <?php endif; ?>
                </div>
                <div class="estate-card-body">
                    <h3><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                    <div class="estate-company"><?= htmlspecialchars($item['publication'] ?? '') ?></div>
                    <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                    <div class="estate-details">
                        <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($item['date'] ?? '') ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="articles-more-btn" style="text-align:center;margin-top:48px;">
            <a href="articles.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
