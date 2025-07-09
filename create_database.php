<?php

// Database configuration
$host = '127.0.0.1';
$port = 3306;
$username = 'root';
$password = '';
$database = 'thanhthanhtung';

// Connect to MySQL without specifying a database
try {
    $pdo = new PDO("mysql:host={$host};port={$port}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to MySQL server successfully.\n";
    
    // Check if database exists
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$database}'");
    $dbExists = $stmt->fetchColumn();
    
    if ($dbExists) {
        echo "Database '{$database}' already exists.\n";
    } else {
        // Create database
        $pdo->exec("CREATE DATABASE `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Database '{$database}' created successfully.\n";
    }
    
    echo "You can now run migrations and seeders.\n";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
} 