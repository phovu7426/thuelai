<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check database tables and counts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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

        $this->info('Database Check:');
        $this->info('---------------');

        foreach ($tables as $table) {
            try {
                $count = DB::table($table)->count();
                $this->info("{$table}: {$count} records");
            } catch (\Exception $e) {
                $this->error("{$table}: Error - {$e->getMessage()}");
            }
        }

        return Command::SUCCESS;
    }
} 