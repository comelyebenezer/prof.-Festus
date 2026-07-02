<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');
$phone = trim($_POST['phone'] ?? '');

$errors = [];
if (empty($name)) $errors[] = 'Please enter your name.';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
if (empty($subject)) $errors[] = 'Please enter a subject.';
if (empty($message)) $errors[] = 'Please enter your message.';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');

// Save to JSON file for admin view
$dataFile = __DIR__ . '/admin/data/contacts.json';
$contacts = [];
if (file_exists($dataFile)) {
    $contacts = json_decode(file_get_contents($dataFile), true) ?? [];
}
$contacts[] = [
    'id' => count($contacts) + 1,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'subject' => $subject,
    'message' => $message,
    'date' => date('Y-m-d H:i:s'),
    'read' => false
];
file_put_contents($dataFile, json_encode($contacts, JSON_PRETTY_PRINT));

// Send email notification
$to = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'drfestusasikhia@gmail.com';
$emailSubject = "Portfolio Contact: {$subject}";
$emailBody = "You have received a new message from your portfolio website.\n\n";
$emailBody .= "Name: {$name}\n";
$emailBody .= "Email: {$email}\n";
if ($phone) $emailBody .= "Phone: {$phone}\n";
$emailBody .= "Subject: {$subject}\n\n";
$emailBody .= "Message:\n{$message}\n";

$headers = "From: {$name} <{$email}>\r\n";
$headers .= "Reply-To: {$email}\r\n";

mail($to, $emailSubject, $emailBody, $headers);

echo json_encode([
    'success' => true,
    'message' => 'Thank you for your message! I will get back to you as soon as possible.'
]);
