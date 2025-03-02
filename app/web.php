<?php

function getRoutes() {
    return [
        '/' => 'handleHome',
        '/tables' => 'handleTables',
        '/posts' => 'handlePosts',
        '/images' => 'handleImages',
        '/videos' => 'handleVideos',
        '/weblinks' => 'handleWeblinks'
    ];
}

function handleHome() {
    echo "<h1>Welcome to Docker PHP Database Demo</h1>";
    echo "<ul>";
    echo "<li><a href='/tables'>View All Tables</a></li>";
    echo "<li><a href='/posts'>View Posts</a></li>";
    echo "<li><a href='/images'>View Images</a></li>";
    echo "<li><a href='/videos'>View Videos</a></li>";
    echo "<li><a href='/weblinks'>View Weblinks</a></li>";
    echo "</ul>";
}

function handleTables() {
    $db = new Database();
    $pdo = $db->connect();

    try {
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        
        echo "<h1>Database Tables</h1>";
        echo "<a href='/'>Back to Home</a><br><br>";
        
        foreach ($tables as $table) {
            echo "<h2>Table: {$table}</h2>";
            
            $stmt = $pdo->query("SELECT * FROM {$table}");
            $rows = $stmt->fetchAll();
            
            if (count($rows) > 0) {
                echo "<table border='1'>";
                echo "<tr>";
                foreach (array_keys($rows[0]) as $column) {
                    echo "<th>{$column}</th>";
                }
                echo "</tr>";
                
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
}

function handlePosts() {
    $db = new Database();
    $pdo = $db->connect();
    
    try {
        $stmt = $pdo->query("SELECT * FROM posts");
        $posts = $stmt->fetchAll();
        
        echo "<h1>Posts</h1>";
        echo "<a href='/'>Back to Home</a><br><br>";
        
        foreach ($posts as $post) {
            echo "<div style='margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;'>";
            echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
            echo "<p>" . htmlspecialchars($post['content']) . "</p>";
            echo "<small>Created at: " . $post['created_at'] . "</small>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

function handleImages() {
    $db = new Database();
    $pdo = $db->connect();
    
    try {
        $stmt = $pdo->query("SELECT i.*, p.title as post_title FROM images i LEFT JOIN posts p ON i.post_id = p.id");
        $images = $stmt->fetchAll();
        
        echo "<h1>Images</h1>";
        echo "<a href='/'>Back to Home</a><br><br>";
        
        foreach ($images as $image) {
            echo "<div style='margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;'>";
            echo "<h2>" . htmlspecialchars($image['post_title']) . "</h2>";
            echo "<p>File Path: " . htmlspecialchars($image['file_path']) . "</p>";
            echo "<img src='/" . htmlspecialchars($image['file_path']) . "' alt='" . htmlspecialchars($image['alt_text']) . "' style='max-width: 300px;'>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

function handleVideos() {
    // Implementation for handling videos
}

function handleWeblinks() {
    // Implementation for handling weblinks
} 