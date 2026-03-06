<?php
/**
 * Test Script - Verify PHP configuration
 */

header('Content-Type: application/json');

$tests = [
    'php_version' => phpversion(),
    'curl_available' => function_exists('curl_init'),
    'json_available' => function_exists('json_encode'),
    'config_exists' => file_exists('config.php'),
    'session_available' => function_exists('session_start'),
    'current_directory' => getcwd(),
    'script_filename' => $_SERVER['SCRIPT_FILENAME'],
    'document_root' => $_SERVER['DOCUMENT_ROOT']
];

// Try to load config
if (file_exists('config.php')) {
    require_once 'config.php';
    $tests['brevo_api_key_defined'] = defined('BREVO_API_KEY');
    $tests['brevo_list_id_defined'] = defined('BREVO_LIST_ID');
    if (defined('BREVO_LIST_ID')) {
        $tests['brevo_list_id_value'] = BREVO_LIST_ID;
    }
} else {
    $tests['config_error'] = 'config.php not found';
}

// Test Brevo API connection
if (function_exists('curl_init') && defined('BREVO_API_KEY')) {
    $ch = curl_init('https://api.brevo.com/v3/account');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'api-key: ' . BREVO_API_KEY,
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $tests['brevo_api_connection'] = ($http_code == 200) ? 'success' : 'failed';
    $tests['brevo_api_http_code'] = $http_code;
}

echo json_encode([
    'success' => true,
    'message' => 'PHP configuration test',
    'tests' => $tests
], JSON_PRETTY_PRINT);
