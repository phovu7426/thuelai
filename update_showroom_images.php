<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$showrooms = App\Models\StoneShowroom::all();
foreach($showrooms as $showroom) {
    $showroom->image = 'stone_showrooms/test_showroom.png';
    $showroom->save();
    echo "Updated showroom: {$showroom->name} - ID: {$showroom->id}" . PHP_EOL;
}
echo "Total: " . count($showrooms) . " showrooms updated" . PHP_EOL; 