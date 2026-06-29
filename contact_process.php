<?php
/**
 * Contact Form Processor
 * Handles AJAX form submissions from the contact section
 */

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Validate required fields
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');
$phone = trim($_POST['phone'] ?? '');

$errors = [];

if (empty($name)) {
    $errors[] = 'Please enter your name.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

if (empty($subject)) {
    $errors[] = 'Please enter a subject.';
}

if (empty($message)) {
    $errors[] = 'Please enter your message.';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');

// Try to save to database
$dbSaved = false;
try {
    require_once __DIR__ . '/includes/config.php';
    $db = getDB();

    if ($db) {
        $stmt = $db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message,
        ]);
        $dbSaved = true;
    }
} catch (Exception $e) {
    // Database save failed, continue to email fallback
    error_log("Contact form DB save failed: " . $e->getMessage());
}

// Send email notification
$to = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'contact@professorfestusasikhia.com';
$emailSubject = "Portfolio Contact: {$subject}";
$emailBody = "You have received a new message from your portfolio website.\n\n";
$emailBody .= "Name: {$name}\n";
$emailBody .= "Email: {$email}\n";
if ($phone) {
    $emailBody .= "Phone: {$phone}\n";
}
$emailBody .= "Subject: {$subject}\n\n";
$emailBody .= "Message:\n{$message}\n";

$headers = "From: {$name} <{$email}>\r\n";
$headers .= "Reply-To: {$email}\r\n";

$emailSent = mail($to, $emailSubject, $emailBody, $headers);

// Response
if ($dbSaved || $emailSent) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! I will get back to you as soon as possible.'
    ]);
} else {
    // Log the message for manual follow-up if both methods fail
    $logFile = __DIR__ . '/assets/contact_log.txt';
    $logEntry = date('Y-m-d H:i:s') . " | Name: {$name} | Email: {$email} | Subject: {$subject}\n";
    @file_put_contents($logFile, $logEntry, FILE_APPEND);

    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! I will get back to you as soon as possible.'
    ]);
}
