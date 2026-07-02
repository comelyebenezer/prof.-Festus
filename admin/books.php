<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Manage Books';
$data_file = 'books.json';
$items = read_json($data_file);
$fields = ['icon', 'title', 'subtitle', 'publisher', 'year', 'pages', 'description', 'full_description', 'highlights'];
$list_fields = ['title', 'publisher', 'year'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $entry = [
            'icon' => $_POST['icon'] ?? 'fa-book',
            'title' => $_POST['title'] ?? '',
            'subtitle' => $_POST['subtitle'] ?? '',
            'publisher' => $_POST['publisher'] ?? '',
            'year' => $_POST['year'] ?? '',
            'pages' => $_POST['pages'] ?? '',
            'description' => $_POST['description'] ?? '',
            'full_description' => $_POST['full_description'] ?? '',
            'highlights' => array_filter(explode("\n", $_POST['highlights'] ?? '')),
        ];
        if ($id && isset($items[$id])) {
            $items[$id] = $entry;
        } else {
            $items[get_next_id($items)] = $entry;
        }
        write_json($data_file, $items);
        header('Location: books.php?msg=saved');
        exit;
    }

    if ($action === 'delete' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        unset($items[$id]);
        write_json($data_file, $items);
        header('Location: books.php?msg=deleted');
        exit;
    }
}

$edit_item = null;
if (isset($_GET['edit'])) {
    $eid = (int)$_GET['edit'];
    $edit_item = $items[$eid] ?? null;
}

$msg = $_GET['msg'] ?? '';
require 'includes/header.php';
?>
<div class="page-header">
    <h1>Books & Publications</h1>
    <button class="btn btn-primary" onclick="document.getElementById('formCard').style.display='block';document.getElementById('formTitle').textContent='Add Book';document.getElementById('itemForm').reset();document.getElementById('itemId').value='0';this.scrollIntoView()">
        <i class="fas fa-plus"></i> Add Book
    </button>
</div>

<?php if ($msg === 'saved'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Book saved successfully.</div><?php endif; ?>
<?php if ($msg === 'deleted'): ?><div class="alert alert-danger"><i class="fas fa-check-circle"></i> Book deleted.</div><?php endif; ?>

<div class="card" id="formCard" style="display:<?= $edit_item ? 'block' : 'none' ?>;">
    <div class="card-header">
        <h2 id="formTitle"><?= $edit_item ? 'Edit Book' : 'Add Book' ?></h2>
        <button class="btn btn-secondary btn-sm" onclick="document.getElementById('formCard').style.display='none'"><i class="fas fa-times"></i></button>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" id="itemId" value="<?= $edit_item ? (int)$_GET['edit'] : '0' ?>">
            <input type="hidden" name="icon" value="fa-book">
            <div class="form-row">
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($edit_item['title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="<?= htmlspecialchars($edit_item['subtitle'] ?? '') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Publisher</label>
                    <input type="text" name="publisher" class="form-control" value="<?= htmlspecialchars($edit_item['publisher'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input type="text" name="year" class="form-control" value="<?= htmlspecialchars($edit_item['year'] ?? '') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Pages</label>
                    <input type="text" name="pages" class="form-control" value="<?= htmlspecialchars($edit_item['pages'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Short Description</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($edit_item['description'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Full Description</label>
                <textarea name="full_description" class="form-control" rows="6"><?= htmlspecialchars($edit_item['full_description'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Highlights (one per line)</label>
                <textarea name="highlights" class="form-control" rows="4"><?= $edit_item ? htmlspecialchars(implode("\n", $edit_item['highlights'] ?? [])) : '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>All Books (<?= count($items) ?>)</h2>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p class="text-muted">No books found.</p>
        <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Publisher</th>
                        <th>Year</th>
                        <th>Pages</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $id => $item): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($item['title'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($item['publisher'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['year'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['pages'] ?? '') ?></td>
                        <td class="actions">
                            <a href="?edit=<?= $id ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <form method="post" style="display:inline" onsubmit="return confirm('Delete this book?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $id ?>">
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
