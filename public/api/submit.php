<?php
/**
 * Form Submission Handler - Team Mehrwert Landing Page
 * Handles contact form submissions and adds contacts to Brevo
 */

require_once 'config.php';

// Set JSON response header
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// CSRF Token Validation - Disabled for now, will implement with proper token generation
// TODO: Add CSRF token generation endpoint and include in form
// if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//     http_response_code(403);
//     echo json_encode(['success' => false, 'error' => 'Invalid security token']);
//     exit;
// }

// Rate Limiting
$ip = $_SERVER['REMOTE_ADDR'];
$rate_limit_key = 'rate_limit_' . md5($ip);

if (!isset($_SESSION[$rate_limit_key])) {
    $_SESSION[$rate_limit_key] = ['count' => 0, 'time' => time()];
}

$rate_data = $_SESSION[$rate_limit_key];
if (time() - $rate_data['time'] > RATE_LIMIT_WINDOW) {
    $_SESSION[$rate_limit_key] = ['count' => 0, 'time' => time()];
    $rate_data = $_SESSION[$rate_limit_key];
}

if ($rate_data['count'] >= RATE_LIMIT_MAX) {
    http_response_code(429);
    echo json_encode(['success' => false, 'error' => 'Too many requests. Please try again later.']);
    exit;
}

// Honeypot Check
if (!empty($_POST['website'])) {
    // Silent fail for bots
    echo json_encode(['success' => true, 'message' => 'Thank you for your submission!']);
    exit;
}

// Validate and sanitize inputs
$vorname = isset($_POST['vorname']) ? trim($_POST['vorname']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$mobilfunknummer = isset($_POST['mobilfunknummer']) ? trim($_POST['mobilfunknummer']) : '';
$mentor = isset($_POST['mentor']) ? trim($_POST['mentor']) : '';
$privacy = isset($_POST['privacy']) ? $_POST['privacy'] : '';
$marketing = isset($_POST['marketing']) ? $_POST['marketing'] : '';

// Validation
$errors = [];

if (strlen($vorname) < 2 || strlen($vorname) > 100) {
    $errors[] = 'Vorname must be between 2 and 100 characters';
}

if (strlen($name) < 2 || strlen($name) > 100) {
    $errors[] = 'Name must be between 2 and 100 characters';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address';
}

// Validate German mobile number
$cleaned_phone = preg_replace('/\s+/', '', $mobilfunknummer);
if (!preg_match('/^(\+49|0049|0)[1-9]\d{9,10}$/', $cleaned_phone)) {
    $errors[] = 'Invalid mobile number';
}

if (strlen($mentor) < 2 || strlen($mentor) > 100) {
    $errors[] = 'Mentor name must be between 2 and 100 characters';
}

if ($privacy !== 'on') {
    $errors[] = 'You must accept the privacy policy';
}

if ($marketing !== 'on') {
    $errors[] = 'You must consent to receive emails';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => implode(', ', $errors)]);
    exit;
}

// Sanitize inputs
$vorname = htmlspecialchars($vorname, ENT_QUOTES, 'UTF-8');
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$mobilfunknummer = htmlspecialchars($mobilfunknummer, ENT_QUOTES, 'UTF-8');
$mentor = htmlspecialchars($mentor, ENT_QUOTES, 'UTF-8');

// Check if curl is available
if (!function_exists('curl_init')) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Server configuration error',
        'debug' => ['message' => 'cURL extension not available']
    ]);
    exit;
}

// Add contact to Brevo
try {
    $brevo_data = [
        'email' => $email,
        'attributes' => [
            'FIRSTNAME' => $vorname,
            'LASTNAME' => $name,
            'SMS' => $cleaned_phone,
            'MENTOR' => $mentor,
            'SIGNUP_DATE' => date('Y-m-d')
        ],
        'listIds' => [BREVO_LIST_ID],
        'updateEnabled' => true
    ];

    $ch = curl_init('https://api.brevo.com/v3/contacts');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($brevo_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'api-key: ' . BREVO_API_KEY,
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code >= 200 && $http_code < 300) {
        // Success - increment rate limit counter
        $_SESSION[$rate_limit_key]['count']++;
        
        echo json_encode([
            'success' => true,
            'message' => 'Vielen Dank für Ihre Anmeldung! Sie erhalten in Kürze eine E-Mail von uns.'
        ]);
    } else {
        // Log detailed error
        error_log("Brevo API Error: HTTP $http_code");
        error_log("Response: $response");
        error_log("Request data: " . json_encode($brevo_data));
        
        // Parse error response
        $error_data = json_decode($response, true);
        $error_message = isset($error_data['message']) ? $error_data['message'] : 'Unknown error';
        
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Es gab ein Problem bei der Anmeldung. Bitte versuchen Sie es später erneut.',
            'debug' => [
                'http_code' => $http_code,
                'brevo_error' => $error_message
            ]
        ]);
    }

} catch (Exception $e) {
    error_log("Exception in submit.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.'
    ]);
}
            'success' => false,
            'error' => 'Es gab ein Problem bei der Anmeldung. Bitte versuchen Sie es später erneut.',
            'debug' => [
                'http_code' => $http_code,
                'brevo_error' => $error_message
            ]
        ]);
    }

} catch (Exception $e) {
    error_log("Exception in submit.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.'
    ]);
}
