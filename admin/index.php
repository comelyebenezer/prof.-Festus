<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $users = json_decode(file_get_contents('data/users.json'), true);
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $users[$username]['name'];
        $_SESSION['admin_username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Prof. Festus Asikhia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        body { margin: 0; }
    </style>
</head>
<body>
<div class="login-page">
    <div class="login-box">
        <div style="text-align:center;margin-bottom:24px;">
            <div style="margin-bottom:12px;"><img src="../assets/images/camp 1.jpeg" alt="Prof. Festus" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid var(--primary);"></div>
            <h1>Admin Login</h1>
            <p>Prof. Festus Uwakhemen Asikhia</p>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required autocomplete="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">Sign In</button>
        </form>
        <div style="text-align:center;margin-top:16px;">
            <a href="../index.php" style="color:var(--text-muted);font-size:0.85rem;text-decoration:none;">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </div>
    </div>
</div>
</body>
</html>
