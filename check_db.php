<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = [
    'users',
    'roles',
    'permissions',
    'stone_categories',
    'stone_products',
    'stone_materials',
    'stone_surfaces',
    'stone_applications',
    'stone_projects',
    'stone_showrooms',
    'stone_videos',
    'posts',
];

echo "Database Check:\n";
echo "---------------\n";

foreach ($tables as $table) {
    try {
        $count = DB::table($table)->count();
        echo "{$table}: {$count} records\n";
    } catch (\Exception $e) {
        echo "{$table}: Error - {$e->getMessage()}\n";
    }
} 