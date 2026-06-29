<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'festus_portfolio');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Site URL configuration
define('SITE_URL', 'http://localhost/festus-portfolio');
define('SITE_NAME', 'Prof. Festus Uwakhemen Asikhia');
define('SITE_TAGLINE', 'Academic | Real Estate Developer | Politician | Entrepreneur');

// Paths
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('INCLUDE_PATH', ROOT_PATH . 'includes' . DIRECTORY_SEPARATOR);
define('SECTION_PATH', INCLUDE_PATH . 'sections' . DIRECTORY_SEPARATOR);
define('ASSET_PATH', SITE_URL . '/assets');
define('IMAGE_PATH', ASSET_PATH . '/images');

// Contact form
define('CONTACT_EMAIL', 'contact@professorfestusasikhia.com');
define('CONTACT_NAME', 'Prof. Festus Uwakhemen Asikhia');

// Database connection
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            return null;
        }
    }
    return $pdo;
}

// Helper function for safe output
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// Get section data helper
function getSectionData($table, $orderBy = 'sort_order', $direction = 'ASC') {
    $db = getDB();
    if (!$db) return [];
    try {
        $stmt = $db->query("SELECT * FROM {$table} WHERE is_active = 1 ORDER BY {$orderBy} {$direction}");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching {$table}: " . $e->getMessage());
        return [];
    }
}

// Get single row
function getRow($table, $where = '1=1') {
    $db = getDB();
    if (!$db) return null;
    try {
        $stmt = $db->query("SELECT * FROM {$table} WHERE {$where} LIMIT 1");
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error fetching {$table}: " . $e->getMessage());
        return null;
    }
}
