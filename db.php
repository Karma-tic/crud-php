<?php
$host = '127.0.0.1';
$dbname = 'php_crud_demo';
$username = 'crud_user'; // Dedicated user created for the app
$password = 'crudpass'; // Password for the dedicated user

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
