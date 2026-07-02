<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Manage Timeline';
$data_file = 'timeline.json';
$items = read_json($data_file);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $entry = [
            'id' => $id ?: 0,
            'year' => $_POST['year'] ?? '',
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
        ];
        if ($id) {
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
        header('Location: timeline.php?msg=saved');
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
        header('Location: timeline.php?msg=deleted');
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
    <h1>Timeline Events</h1>
    <button class="btn btn-primary" onclick="document.getElementById('formCard').style.display='block';document.getElementById('formTitle').textContent='Add Timeline Event';document.getElementById('itemForm').reset();document.getElementById('itemId').value='0';this.scrollIntoView()">
        <i class="fas fa-plus"></i> Add Event
    </button>
</div>

<?php if ($msg === 'saved'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Timeline event saved.</div><?php endif; ?>
<?php if ($msg === 'deleted'): ?><div class="alert alert-danger"><i class="fas fa-check-circle"></i> Timeline event deleted.</div><?php endif; ?>

<div class="card" id="formCard" style="display:<?= $edit_item ? 'block' : 'none' ?>;">
    <div class="card-header">
        <h2 id="formTitle"><?= $edit_item ? 'Edit Timeline Event' : 'Add Timeline Event' ?></h2>
        <button class="btn btn-secondary btn-sm" onclick="document.getElementById('formCard').style.display='none'"><i class="fas fa-times"></i></button>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" id="itemId" value="<?= $edit_item['id'] ?? '0' ?>">
            <div class="form-row">
                <div class="form-group">
                    <label>Year *</label>
                    <input type="text" name="year" class="form-control" required value="<?= htmlspecialchars($edit_item['year'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($edit_item['title'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($edit_item['description'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>All Timeline Events (<?= count($items) ?>)</h2>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p class="text-muted">No timeline events found.</p>
        <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Title</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($item['year'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($item['title'] ?? '') ?></td>
                        <td class="actions">
                            <a href="?edit=<?= $item['id'] ?? 0 ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <form method="post" style="display:inline" onsubmit="return confirm('Delete this event?');">
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
