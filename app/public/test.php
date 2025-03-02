<?php
require_once __DIR__ . '/../Database.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $db = new Database();
    $pdo = $db->connect();
    echo "Successfully connected to the database!<br>";
    
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Available tables: <pre>" . print_r($tables, true) . "</pre>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}