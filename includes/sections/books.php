<?php require 'includes/data_loader.php'; ?>
<?php $all_items = load_data('books.json'); ksort($all_items); $books = array_slice($all_items, 0, 3, true); ?>
<section class="books section-padding" id="books">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Publications</span>
            <h2 class="section-title">Books & Publications</h2>
            <p class="section-subtitle">
                A prolific author with over 12 published works covering leadership, education,
                national development, and personal transformation.
            </p>
        </div>

        <div class="books-grid stagger-children">
            <?php foreach ($books as $id => $item): ?>
            <a href="single-book.php?id=<?= htmlspecialchars($id) ?>" class="book-card">
                <div class="book-icon"><i class="<?= htmlspecialchars($item['icon'] ?? 'fas fa-book') ?>"></i></div>
                <div class="book-info">
                    <h4><?= htmlspecialchars($item['title'] ?? '') ?></h4>
                    <div class="book-subtitle"><?= htmlspecialchars($item['subtitle'] ?? '') ?></div>
                    <div class="book-meta">
                        <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($item['year'] ?? '') ?></span>
                        <span><i class="fas fa-building"></i> <?= htmlspecialchars($item['publisher'] ?? '') ?></span>
                        <span><i class="fas fa-book-open"></i> <?= htmlspecialchars($item['pages'] ?? '') ?></span>
                    </div>
                    <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="books-more-btn">
            <a href="books.php" class="btn btn-outline">
                See More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
