<?php

try {
    $host = '127.0.0.1';
    $dbname = 'web';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully to database: $dbname\n";
    
    // Kiểm tra bảng stone_products
    $stmt = $pdo->query("SHOW TABLES LIKE 'stone_products'");
    $exists = $stmt->rowCount() > 0;
    
    if ($exists) {
        echo "Table 'stone_products' exists.\n";
        
        // Đếm số bản ghi
        $stmt = $pdo->query("SELECT COUNT(*) FROM stone_products");
        $count = $stmt->fetchColumn();
        echo "There are $count records in 'stone_products' table.\n";
    } else {
        echo "Table 'stone_products' does not exist.\n";
        
        // Liệt kê tất cả các bảng
        echo "Available tables:\n";
        $stmt = $pdo->query("SHOW TABLES");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "- " . $row[0] . "\n";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
} 