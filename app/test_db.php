<?php
require_once 'Database.php';

$db = new Database();
$pdo = $db->connect();

try {
    // Get all tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h1>Database Tables</h1>";
    
    foreach ($tables as $table) {
        echo "<h2>Table: {$table}</h2>";
        
        // Get table contents
        $stmt = $pdo->query("SELECT * FROM {$table}");
        $rows = $stmt->fetchAll();
        
        if (count($rows) > 0) {
            echo "<table border='1'>";
            // Table headers
            echo "<tr>";
            foreach (array_keys($rows[0]) as $column) {
                echo "<th>{$column}</th>";
            }
            echo "</tr>";
            
            // Table data
            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data in this table.</p>";
        }
        echo "<br>";
    }
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
} 