<?php
require 'includes/auth.php';
require 'includes/functions.php';
$page_title = 'Settings';
$data_file = 'users.json';
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'change_password') {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $users = read_json($data_file);
        $admin = $users['admin'] ?? null;
        if (!$admin) {
            $message = 'Admin user not found.';
            $message_type = 'danger';
        } elseif (!password_verify($current, $admin['password'])) {
            $message = 'Current password is incorrect.';
            $message_type = 'danger';
        } elseif (strlen($new) < 6) {
            $message = 'New password must be at least 6 characters.';
            $message_type = 'danger';
        } elseif ($new !== $confirm) {
            $message = 'New password and confirmation do not match.';
            $message_type = 'danger';
        } else {
            $users['admin']['password'] = password_hash($new, PASSWORD_DEFAULT);
            write_json($data_file, $users);
            $message = 'Password changed successfully.';
            $message_type = 'success';
        }
    }
}

require 'includes/header.php';
?>
<div class="page-header">
    <h1>Settings</h1>
</div>

<?php if ($message): ?><div class="alert alert-<?= $message_type ?>"><i class="fas fa-<?= $message_type === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i> <?= htmlspecialchars($message) ?></div><?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>Change Admin Password</h2>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="action" value="change_password">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" required minlength="6">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Change Password</button>
        </form>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
