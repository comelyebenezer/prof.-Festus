<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Manage Blog';
$data_file = 'blog.json';
$items = read_json($data_file);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $entry = [
            'id' => $id ?: 0,
            'category' => $_POST['category'] ?? '',
            'title' => $_POST['title'] ?? '',
            'date' => $_POST['date'] ?? '',
            'author' => $_POST['author'] ?? 'Prof. Festus Uwakhemen Asikhia',
            'image' => $_POST['image'] ?: null,
            'source' => $_POST['source'] ?: null,
            'source_url' => $_POST['source_url'] ?: null,
            'excerpt' => $_POST['excerpt'] ?? '',
            'content' => array_filter(explode("\n---\n", $_POST['content'] ?? '')),
            'tags' => array_map('trim', explode(',', $_POST['tags'] ?? '')),
        ];
        if ($id && isset($items[$id])) {
            // Find by id field
            foreach ($items as $k => $v) {
                if (($v['id'] ?? 0) === $id) {
                    $entry['id'] = $id;
                    $items[$k] = $entry;
                    break;
                }
            }
        } else {
            $entry['id'] = get_next_id($items);
            $items[] = $entry;
        }
        write_json($data_file, $items);
        header('Location: blog.php?msg=saved');
        exit;
    }

    if ($action === 'delete' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        foreach ($items as $k => $v) {
            if (($v['id'] ?? 0) === $id) {
                array_splice($items, $k, 1);
                break;
            }
        }
        write_json($data_file, $items);
        header('Location: blog.php?msg=deleted');
        exit;
    }
}

$edit_item = null;
if (isset($_GET['edit'])) {
    $eid = (int)$_GET['edit'];
    foreach ($items as $v) {
        if (($v['id'] ?? 0) === $eid) { $edit_item = $v; break; }
    }
}

$msg = $_GET['msg'] ?? '';
require 'includes/header.php';
?>
<div class="page-header">
    <h1>Blog Posts</h1>
    <button class="btn btn-primary" onclick="document.getElementById('formCard').style.display='block';document.getElementById('formTitle').textContent='Add Blog Post';document.getElementById('itemForm').reset();document.getElementById('itemId').value='0';this.scrollIntoView()">
        <i class="fas fa-plus"></i> Add Post
    </button>
</div>

<?php if ($msg === 'saved'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Blog post saved.</div><?php endif; ?>
<?php if ($msg === 'deleted'): ?><div class="alert alert-danger"><i class="fas fa-check-circle"></i> Blog post deleted.</div><?php endif; ?>

<div class="card" id="formCard" style="display:<?= $edit_item ? 'block' : 'none' ?>;">
    <div class="card-header">
        <h2 id="formTitle"><?= $edit_item ? 'Edit Post' : 'Add Post' ?></h2>
        <button class="btn btn-secondary btn-sm" onclick="document.getElementById('formCard').style.display='none'"><i class="fas fa-times"></i></button>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" id="itemId" value="<?= $edit_item['id'] ?? '0' ?>">
            <div class="form-row">
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($edit_item['title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($edit_item['category'] ?? '') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" name="date" class="form-control" value="<?= htmlspecialchars($edit_item['date'] ?? '') ?>" placeholder="e.g. March 15, 2026">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($edit_item['author'] ?? 'Prof. Festus Uwakhemen Asikhia') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Image Path (optional)</label>
                    <input type="text" name="image" class="form-control" value="<?= htmlspecialchars($edit_item['image'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Tags (comma separated)</label>
                    <input type="text" name="tags" class="form-control" value="<?= $edit_item ? htmlspecialchars(implode(', ', $edit_item['tags'] ?? [])) : '' ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Source Name (for external articles)</label>
                    <input type="text" name="source" class="form-control" value="<?= htmlspecialchars($edit_item['source'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Source URL</label>
                    <input type="text" name="source_url" class="form-control" value="<?= htmlspecialchars($edit_item['source_url'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Excerpt / Summary</label>
                <textarea name="excerpt" class="form-control" rows="3"><?= htmlspecialchars($edit_item['excerpt'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Content (separate paragraphs with --- on a line by itself)</label>
                <textarea name="content" class="form-control" rows="10"><?= $edit_item ? htmlspecialchars(implode("\n---\n", $edit_item['content'] ?? [])) : '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>All Blog Posts (<?= count($items) ?>)</h2>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p class="text-muted">No blog posts found.</p>
        <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($item['title'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($item['category'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['date'] ?? '') ?></td>
                        <td class="actions">
                            <a href="?edit=<?= $item['id'] ?? 0 ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <form method="post" style="display:inline" onsubmit="return confirm('Delete this post?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $item['id'] ?? 0 ?>">
                                <button type="submit" class="btn-delete" style="border:none;cursor:pointer;padding:4px 10px;border-radius:4px;font-size:0.8rem;background:rgba(239,68,68,0.1);color:var(--danger);"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
