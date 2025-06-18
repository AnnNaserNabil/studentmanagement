<?php
// Function to parse database URL
function parseDatabaseUrl($url) {
    // Default values
    $dbConfig = [
        'host' => 'localhost',
        'port' => 3306,
        'database' => '',
        'username' => 'root',
        'password' => ''
    ];

    // Parse the URL if it exists
    if ($url = getenv('MYSQL_URL') ?: $url) {
        $url = parse_url($url);
        
        if (isset($url['host'])) $dbConfig['host'] = $url['host'];
        if (isset($url['port'])) $dbConfig['port'] = $url['port'];
        if (isset($url['user'])) $dbConfig['username'] = $url['user'];
        if (isset($url['pass'])) $dbConfig['password'] = $url['pass'];
        if (isset($url['path'])) $dbConfig['database'] = ltrim($url['path'], '/');
    }
    
    // Allow individual environment variables to override
    if (getenv('DB_HOST')) $dbConfig['host'] = getenv('DB_HOST');
    if (getenv('DB_PORT')) $dbConfig['port'] = getenv('DB_PORT');
    if (getenv('DB_DATABASE')) $dbConfig['database'] = getenv('DB_DATABASE');
    if (getenv('DB_USERNAME')) $dbConfig['username'] = getenv('DB_USERNAME');
    if (getenv('DB_PASSWORD')) $dbConfig['password'] = getenv('DB_PASSWORD');
    
    return $dbConfig;
}

// Get database configuration
$db_config = parseDatabaseUrl('');

// Create a database connection
function getDbConnection() {
    global $db_config;
    
    // Enable error reporting for database connection
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    try {
        $conn = new mysqli(
            $db_config['host'],
            $db_config['username'],
            $db_config['password'],
            $db_config['database'],
            $db_config['port']
        );
        
        // Set charset to ensure proper encoding
        $conn->set_charset('utf8mb4');
        
        return $conn;
    } catch (mysqli_sql_exception $e) {
        $error_message = "Database connection failed: " . $e->getMessage();
        error_log($error_message);
        
        if (php_sapi_name() === 'cli') {
            die("Database connection failed: " . $e->getMessage() . "\n");
        } else {
            // Don't expose sensitive information in production
            if (getenv('APP_ENV') === 'production') {
                die("<h2>Database connection error. Please try again later.</h2>");
            } else {
                die("<h2>Database Error</h2><p>" . htmlspecialchars($e->getMessage()) . "</p>");
            }
        }
    }
}

// Include this in your files with: require_once 'config.php';
?>
