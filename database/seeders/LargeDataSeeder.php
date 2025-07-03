<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\StoneShowroom;
use App\Models\StoneProduct;
use App\Models\StoneCategory;
use App\Models\StoneMaterial;
use App\Models\StoneSurface;
use App\Models\StoneApplication;
use App\Models\StoneProject;
use App\Models\StoneVideo;
use App\Models\StoneContact;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;
use App\Models\Area;
use App\Models\Slide;
use App\Models\ContactInfo;
use Illuminate\Console\Command;
use App\Enums\BasicStatus;

class LargeDataSeeder extends Seeder
{
    /**
     * The console command instance.
     *
     * @var \Illuminate\Console\Command
     */
    protected $command;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Generate 1000 users
        $this->log('Generating 1000 users...');
        for ($i = 0; $i < 1000; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} users");
            }
        }
        
        // Generate 1000 stone showrooms
        $this->log('Generating 1000 stone showrooms...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->company . ' Showroom ' . ($i + 1);
            StoneShowroom::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph(3),
                'address' => $faker->address,
                'province' => $faker->state,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'hotline' => $faker->phoneNumber,
                'contact_person' => $faker->name,
                'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0966477015896!2d105.78273007499855!3d21.02887358062036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0xea31563511af2e54!2zOCBQaOG7kSBU4buNIEjhu691LCBUcnVuZyBWxINuLCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1701923823839!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} showrooms");
            }
        }
        
        // Generate 1000 stone categories
        $this->log('Generating 1000 stone categories...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->word . ' Stone ' . ($i + 1);
            StoneCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone categories");
            }
        }
        
        // Generate 1000 stone materials
        $this->log('Generating 1000 stone materials...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->word . ' Material ' . ($i + 1);
            StoneMaterial::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone materials");
            }
        }
        
        // Generate 1000 stone surfaces
        $this->log('Generating 1000 stone surfaces...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->word . ' Surface ' . ($i + 1);
            StoneSurface::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone surfaces");
            }
        }
        
        // Generate 1000 stone applications
        $this->log('Generating 1000 stone applications...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->word . ' Application ' . ($i + 1);
            StoneApplication::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'content' => $faker->paragraphs(5, true),
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone applications");
            }
        }
        
        // Generate 1000 stone products
        $this->log('Generating 1000 stone products...');
        $categoryIds = StoneCategory::pluck('id')->toArray();
        $materialIds = StoneMaterial::pluck('id')->toArray();
        $surfaceIds = StoneSurface::pluck('id')->toArray();
        
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->word . ' Product ' . ($i + 1);
            StoneProduct::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'code' => strtoupper(Str::random(6)),
                'description' => $faker->paragraph,
                'content' => $faker->paragraphs(5, true),
                'category_id' => $faker->randomElement($categoryIds),
                'material_id' => $faker->randomElement($materialIds),
                'surface_id' => $faker->randomElement($surfaceIds),
                'price' => $faker->randomFloat(2, 100, 10000),
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone products");
            }
        }
        
        // Generate 1000 stone projects
        $this->log('Generating 1000 stone projects...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->company . ' Project ' . ($i + 1);
            StoneProject::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'content' => $faker->paragraphs(5, true),
                'address' => $faker->address,
                'province' => $faker->state,
                'client' => $faker->company,
                'area' => $faker->randomFloat(2, 100, 10000),
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone projects");
            }
        }
        
        // Generate 1000 stone videos
        $this->log('Generating 1000 stone videos...');
        for ($i = 0; $i < 1000; $i++) {
            $title = 'Video ' . ($i + 1) . ': ' . $faker->sentence;
            StoneVideo::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph,
                'video_url' => 'https://www.youtube.com/watch?v=' . Str::random(11),
                'thumbnail' => 'default/default_image.png',
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone videos");
            }
        }
        
        // Generate 1000 stone contacts
        $this->log('Generating 1000 stone contacts...');
        for ($i = 0; $i < 1000; $i++) {
            StoneContact::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'subject' => $faker->sentence,
                'message' => $faker->paragraph,
                'status' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} stone contacts");
            }
        }
        
        // Generate 1000 posts
        $this->log('Generating 1000 posts...');
        $users = User::all()->pluck('id')->toArray();
        // Nếu không có user nào, tạo một user mới
        if (empty($users)) {
            $userId = User::create([
                'name' => 'Admin User',
                'email' => 'admin' . time() . '@example.com',
                'password' => bcrypt('password'),
                'status' => 'active',
            ])->id;
            $users = [$userId];
        }
        
        for ($i = 0; $i < 1000; $i++) {
            $name = 'Post ' . ($i + 1) . ': ' . $faker->sentence;
            Post::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'content' => $faker->paragraphs(5, true),
                'image' => 'default/default_image.png',
                'status' => $faker->randomElement(BasicStatus::values()),
                'user_id' => $faker->randomElement($users),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} posts");
            }
        }
        
        // Generate 1000 blog categories
        $this->log('Generating 1000 blog categories...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->word . ' Category ' . ($i + 1);
            $code = strtoupper(Str::substr(Str::slug($name), 0, 10) . '-' . ($i + 1));
            Category::create([
                'name' => $name,
                'code' => $code,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} blog categories");
            }
        }
        
        
        
        // Generate 1000 slides
        $this->log('Generating 1000 slides...');
        for ($i = 0; $i < 1000; $i++) {
            $title = 'Slide ' . ($i + 1) . ': ' . $faker->sentence;
            Slide::create([
                'title' => $title,
                'description' => $faker->paragraph,
                'image' => 'default/default_image.png',
                'link' => $faker->url,
                'status' => $faker->randomElement([0, 1]),
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} slides");
            }
        }
        
        // Generate 1000 contact infos
        $this->log('Generating 1000 contact infos...');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->company . ' Contact ' . ($i + 1);
            ContactInfo::create([
                'name' => $name,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0966477015896!2d105.78273007499855!3d21.02887358062036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4cd0c66f05%3A0xea31563511af2e54!2zOCBQaOG7kSBU4buNIEjhu691LCBUcnVuZyBWxINuLCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1701923823839!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
            
            if ($i % 100 === 0) {
                $this->log("Generated {$i} contact infos");
            }
        }
    }
    
    /**
     * Log a message to the console.
     *
     * @param  string  $message
     * @return void
     */
    protected function log($message)
    {
        if ($this->command) {
            $this->command->info($message);
        } else {
            echo $message . PHP_EOL;
        }
    }
    
    /**
     * Set the console command instance.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return $this
     */
    public function setCommand(Command $command)
    {
        $this->command = $command;
        
        return $this;
    }
}