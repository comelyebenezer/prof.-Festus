<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Manage Academics';
$data_file = 'academics.json';
$items = read_json($data_file);
$fields = ['icon', 'institution', 'degree', 'year', 'title', 'focus', 'description', 'full_description', 'highlights'];
$list_fields = ['institution', 'degree', 'year'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $entry = [
            'icon' => $_POST['icon'] ?? 'fa-graduation-cap',
            'institution' => $_POST['institution'] ?? '',
            'degree' => $_POST['degree'] ?? '',
            'year' => $_POST['year'] ?? '',
            'title' => $_POST['title'] ?? '',
            'focus' => $_POST['focus'] ?? '',
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
        header('Location: academics.php?msg=saved');
        exit;
    }

    if ($action === 'delete' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        unset($items[$id]);
        write_json($data_file, $items);
        header('Location: academics.php?msg=deleted');
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
    <h1>Academic Background</h1>
    <button class="btn btn-primary" onclick="document.getElementById('formCard').style.display='block';document.getElementById('formTitle').textContent='Add Academic Entry';document.getElementById('itemForm').reset();document.getElementById('itemId').value='0';this.scrollIntoView()">
        <i class="fas fa-plus"></i> Add Academic Entry
    </button>
</div>

<?php if ($msg === 'saved'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Academic entry saved successfully.</div><?php endif; ?>
<?php if ($msg === 'deleted'): ?><div class="alert alert-danger"><i class="fas fa-check-circle"></i> Academic entry deleted.</div><?php endif; ?>

<div class="card" id="formCard" style="display:<?= $edit_item ? 'block' : 'none' ?>;">
    <div class="card-header">
        <h2 id="formTitle"><?= $edit_item ? 'Edit Academic Entry' : 'Add Academic Entry' ?></h2>
        <button class="btn btn-secondary btn-sm" onclick="document.getElementById('formCard').style.display='none'"><i class="fas fa-times"></i></button>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" id="itemId" value="<?= $edit_item ? (int)$_GET['edit'] : '0' ?>">
            <input type="hidden" name="icon" value="fa-graduation-cap">
            <div class="form-row">
                <div class="form-group">
                    <label>Institution *</label>
                    <input type="text" name="institution" class="form-control" required value="<?= htmlspecialchars($edit_item['institution'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Degree</label>
                    <input type="text" name="degree" class="form-control" value="<?= htmlspecialchars($edit_item['degree'] ?? '') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Year</label>
                    <input type="text" name="year" class="form-control" value="<?= htmlspecialchars($edit_item['year'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($edit_item['title'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Focus</label>
                <input type="text" name="focus" class="form-control" value="<?= htmlspecialchars($edit_item['focus'] ?? '') ?>">
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
        <h2>All Academic Entries (<?= count($items) ?>)</h2>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p class="text-muted">No academic entries found.</p>
        <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Institution</th>
                        <th>Degree</th>
                        <th>Year</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $id => $item): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($item['institution'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($item['degree'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['year'] ?? '') ?></td>
                        <td class="actions">
                            <a href="?edit=<?= $id ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <form method="post" style="display:inline" onsubmit="return confirm('Delete this entry?');">
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
