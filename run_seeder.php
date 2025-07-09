<?php

// This script sets up the database connection and runs the ThanhThanhTungSeeder

// Include the autoloader
require __DIR__.'/vendor/autoload.php';

// Create Laravel application
$app = require_once __DIR__.'/bootstrap/app.php';

// Get the kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Set up database configuration
$config = $app['config'];
$config->set('database.default', 'mysql');
$config->set('database.connections.mysql.host', '127.0.0.1');
$config->set('database.connections.mysql.port', '3306');
$config->set('database.connections.mysql.database', 'thanhthanhtung');
$config->set('database.connections.mysql.username', 'root');
$config->set('database.connections.mysql.password', '');

// Test database connection
try {
    $connection = $app['db']->connection();
    echo "Database connection successful!\n";
    
    // Run migrations if needed
    if ($argc > 1 && $argv[1] === '--migrate') {
        echo "Running migrations...\n";
        $kernel->call('migrate');
    }
    
    // Run the seeder
    echo "Running ThanhThanhTungSeeder...\n";
    
    // Include the seeder class
    require_once __DIR__.'/database/seeders/ThanhThanhTungSeeder.php';
    
    // Create and run the seeder
    $seeder = new Database\Seeders\ThanhThanhTungSeeder();
    $seeder->run();
    
    echo "Seeding completed successfully!\n";
    
} catch (\Exception $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
} 