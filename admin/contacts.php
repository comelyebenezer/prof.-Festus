<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Contact Messages';
$data_file = 'contacts.json';
$items = read_json($data_file);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        if (isset($items[$id])) {
            unset($items[$id]);
            $items = array_values($items);
            write_json($data_file, $items);
        }
        header('Location: contacts.php?msg=deleted');
        exit;
    }
}

$msg = $_GET['msg'] ?? '';
require 'includes/header.php';
?>
<div class="page-header">
    <h1>Contact Messages</h1>
</div>

<?php if ($msg === 'deleted'): ?><div class="alert alert-danger"><i class="fas fa-check-circle"></i> Message deleted.</div><?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>All Messages (<?= count($items) ?>)</h2>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p class="text-muted">No messages yet.</p>
        <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $id => $item): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($item['name'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($item['email'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['subject'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['date'] ?? '') ?></td>
                        <td><?= htmlspecialchars(truncate($item['message'] ?? '', 100)) ?></td>
                        <td class="actions">
                            <form method="post" style="display:inline" onsubmit="return confirm('Delete this message?');">
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
