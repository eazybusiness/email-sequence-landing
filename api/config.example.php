<?php
/**
 * Configuration File Template - Team Mehrwert Landing Page
 * 
 * INSTRUCTIONS:
 * 1. Copy this file to config.php
 * 2. Replace all placeholder values with your actual credentials
 * 3. Never commit config.php to git (it's in .gitignore)
 */

// Brevo API Configuration
define('BREVO_API_KEY', 'your-brevo-api-key-here');
define('BREVO_LIST_ID', 2); // Your Brevo contact list ID
define('BREVO_SENDER_EMAIL', 'Office@teammehrwert.info');
define('BREVO_SENDER_NAME', 'Team Mehrwert');

// Site Configuration
define('SITE_URL', 'https://teammehrwert.info');
define('ENABLE_DOUBLE_OPT_IN', false); // Not required - private link access only

// Security Configuration
define('CSRF_TOKEN_NAME', 'csrf_token');
define('RATE_LIMIT_MAX', 3); // Max submissions per IP per hour
define('RATE_LIMIT_WINDOW', 3600); // Time window in seconds (1 hour)

// Error Reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/php-errors.log');

// Session Configuration
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => true,
        'cookie_samesite' => 'Strict'
    ]);
}
