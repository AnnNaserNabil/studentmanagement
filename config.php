<?php
// Database configuration with environment variables
$db_config = [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => getenv('DB_PORT') ?: 4306,
    'database' => getenv('DB_DATABASE') ?: 'schoolproject',
    'username' => getenv('DB_USERNAME') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: ''
];

// Create a database connection
function getDbConnection() {
    global $db_config;
    
    $conn = mysqli_connect(
        $db_config['host'],
        $db_config['username'],
        $db_config['password'],
        $db_config['database'],
        $db_config['port']
    );

    if ($conn === false) {
        error_log("Database connection failed: " . mysqli_connect_error());
        if (php_sapi_name() === 'cli') {
            die("Database connection failed. Check error logs for details.\n");
        } else {
            die("<h2>Database connection error. Please try again later.</h2>");
        }
    }
    
    return $conn;
}

// Include this in your files with: require_once 'config.php';
?>
