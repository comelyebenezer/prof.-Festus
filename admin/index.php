<?php
/**
 * Admin Panel - Simple content management
 * Default credentials: admin / admin123
 */

session_start();

// Simple authentication
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', password_hash('admin123', PASSWORD_DEFAULT));

$error = '';
$loggedIn = false;

// Check login
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $loggedIn = true;
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USER && password_verify($password, ADMIN_PASS)) {
        $_SESSION['admin_logged_in'] = true;
        $loggedIn = true;
    } else {
        $error = 'Invalid credentials!';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Handle database connection test
$dbStatus = false;
if ($loggedIn) {
    try {
        require_once __DIR__ . '/../includes/config.php';
        $db = getDB();
        $dbStatus = ($db !== null);
    } catch (Exception $e) {
        $dbStatus = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Prof. Festus Asikhia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#0a0e1a; color:#e2e8f0; min-height:100vh; display:flex; align-items:center; justify-content:center; }
        .login-box { background:#1a1f2e; border:1px solid #2a3040; border-radius:16px; padding:40px; width:100%; max-width:400px; }
        .login-box h1 { font-size:1.3rem; margin-bottom:8px; color:#fff; }
        .login-box p { color:#94a3b8; font-size:0.9rem; margin-bottom:24px; }
        .form-group { margin-bottom:16px; }
        .form-group label { display:block; font-size:0.85rem; color:#e2e8f0; margin-bottom:6px; }
        .form-group input { width:100%; padding:12px 16px; background:#111827; border:1px solid #2a3040; border-radius:8px; color:#fff; font-size:0.95rem; outline:none; transition:border-color 0.3s; }
        .form-group input:focus { border-color:#d4a843; }
        .btn { width:100%; padding:12px; background:#d4a843; color:#0a0e1a; border:none; border-radius:8px; font-weight:600; font-size:0.95rem; cursor:pointer; transition:background 0.3s; }
        .btn:hover { background:#e8c46a; }
        .error { color:#ef4444; font-size:0.85rem; margin-bottom:16px; text-align:center; }
        .dashboard { width:100%; max-width:800px; }
        .dashboard .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:32px; }
        .dashboard .header h1 { font-size:1.5rem; }
        .dashboard .header a { color:#d4a843; text-decoration:none; font-size:0.9rem; }
        .cards { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:16px; }
        .card { background:#1a1f2e; border:1px solid #2a3040; border-radius:12px; padding:24px; text-align:center; }
        .card .icon { font-size:2rem; color:#d4a843; margin-bottom:12px; }
        .card .count { font-size:2rem; font-weight:700; color:#fff; }
        .card .label { font-size:0.85rem; color:#94a3b8; margin-top:4px; }
        .status { text-align:center; padding:20px; }
        .status .connected { color:#10b981; }
        .status .disconnected { color:#ef4444; }
        .credentials { margin-top:24px; padding:16px; background:rgba(212,168,67,0.05); border:1px solid rgba(212,168,67,0.15); border-radius:8px; font-size:0.8rem; color:#94a3b8; }
    </style>
</head>
<body>
    <?php if (!$loggedIn): ?>
    <div class="login-box">
        <h1><i class="fas fa-lock" style="color:#d4a843;"></i> Admin Access</h1>
        <p>Enter your credentials to manage the portfolio.</p>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="admin">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" name="login" class="btn">Sign In</button>
        </form>
        <div class="credentials">
            <strong>Default:</strong> admin / admin123
        </div>
    </div>
    <?php else: ?>
    <div class="dashboard">
        <div class="header">
            <h1><i class="fas fa-cog" style="color:#d4a843;"></i> Dashboard</h1>
            <div>
                <a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

        <div class="status">
            <i class="fas fa-circle <?= $dbStatus ? 'connected' : 'disconnected' ?>"></i>
            Database: <?= $dbStatus ? 'Connected' : 'Disconnected' ?>
        </div>

        <div class="cards">
            <div class="card">
                <div class="icon"><i class="fas fa-book"></i></div>
                <div class="count">12</div>
                <div class="label">Books</div>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-trophy"></i></div>
                <div class="count">25</div>
                <div class="label">Awards</div>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-building"></i></div>
                <div class="count">6</div>
                <div class="label">Properties</div>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-envelope"></i></div>
                <div class="count">-</div>
                <div class="label">Messages</div>
            </div>
        </div>

        <div style="margin-top:32px; text-align:center; color:#94a3b8; font-size:0.85rem;">
            <p>Full content management coming soon. For now, edit the PHP files directly to update content.</p>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
