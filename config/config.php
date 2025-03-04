<?php
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('DBNAME')) {
    define('DBNAME', 'cafeteria');
}
if (!defined('USER')) {
    define('USER', 'root');
}
if (!defined('PASS')) {
    define('PASS', '');
}

try {
    $conn = new PDO(
        "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8",
        USER,
        PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    );
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
