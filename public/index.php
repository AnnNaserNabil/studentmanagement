<?php
// Show PHP info for debugging
phpinfo();

// Simple routing for testing
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        echo '<h1>Welcome to Student Management System</h1>';
        echo '<p>If you see this, the PHP server is working correctly!</p>';
        break;
    case '' :
        require __DIR__ . '/index.php';
        break;
    default:
        http_response_code(404);
        echo '<h1>404 Not Found</h1>';
        break;
}
