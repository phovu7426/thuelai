<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
use App\Models\Role;
use App\Models\Series;
use App\Enums\BasicStatus;

class SeedTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed-table {table} {count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed a specific table with a number of records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');
        $count = (int) $this->argument('count');

        $this->info("Starting to seed {$count} records for table {$table}...");

        $faker = Faker::create();
        $start = microtime(true);

        switch ($table) {
            case 'users':
                $this->seedUsers($count, $faker);
                break;

            case 'stone_showrooms':
                $this->seedShowrooms($count, $faker);
                break;

            case 'stone_categories':
                $this->seedStoneCategories($count, $faker);
                break;

            case 'stone_materials':
                $this->seedStoneMaterials($count, $faker);
                break;

            case 'stone_surfaces':
                $this->seedStoneSurfaces($count, $faker);
                break;

            case 'stone_applications':
                $this->seedStoneApplications($count, $faker);
                break;

            case 'stone_products':
                $this->seedStoneProducts($count, $faker);
                break;

            case 'stone_projects':
                $this->seedStoneProjects($count, $faker);
                break;

            case 'stone_videos':
                $this->seedStoneVideos($count, $faker);
                break;

            case 'stone_contacts':
                $this->seedStoneContacts($count, $faker);
                break;

            case 'posts':
                $this->seedPosts($count, $faker);
                break;

            case 'categories':
                $this->seedCategories($count, $faker);
                break;

            case 'authors':
                $this->seedAuthors($count, $faker);
                break;

            case 'books':
                $this->seedBooks($count, $faker);
                break;

            case 'areas':
                $this->seedAreas($count, $faker);
                break;

            case 'slides':
                $this->seedSlides($count, $faker);
                break;

            case 'contact_infos':
                $this->seedContactInfos($count, $faker);
                break;

            default:
                $this->error("Table {$table} is not supported for seeding.");
                return Command::FAILURE;
        }

        $time = microtime(true) - $start;
        $this->info("Seeded {$count} records for table {$table} in {$time} seconds!");

        return Command::SUCCESS;
    }

    private function seedUsers($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);

            if ($i % 100 === 0) {
                $this->info("Generated {$i} users");
            }
        }
    }

    private function seedShowrooms($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} showrooms");
            }
        }
    }

    private function seedStoneCategories($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone categories");
            }
        }
    }

    private function seedStoneMaterials($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone materials");
            }
        }
    }

    private function seedStoneSurfaces($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone surfaces");
            }
        }
    }

    private function seedStoneApplications($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone applications");
            }
        }
    }

    private function seedStoneProducts($count, $faker)
    {
        $categoryIds = StoneCategory::pluck('id')->toArray();
        $materialIds = StoneMaterial::pluck('id')->toArray();
        $surfaceIds = StoneSurface::pluck('id')->toArray();

        // Check if we need to create categories, materials and surfaces first
        if (empty($categoryIds)) {
            $this->seedStoneCategories(10, $faker);
            $categoryIds = StoneCategory::pluck('id')->toArray();
        }

        if (empty($materialIds)) {
            $this->seedStoneMaterials(10, $faker);
            $materialIds = StoneMaterial::pluck('id')->toArray();
        }

        if (empty($surfaceIds)) {
            $this->seedStoneSurfaces(10, $faker);
            $surfaceIds = StoneSurface::pluck('id')->toArray();
        }

        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone products");
            }
        }
    }

    private function seedStoneProjects($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone projects");
            }
        }
    }

    private function seedStoneVideos($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone videos");
            }
        }
    }

    private function seedStoneContacts($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} stone contacts");
            }
        }
    }

    private function seedPosts($count, $faker)
    {
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

        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} posts");
            }
        }
    }

    private function seedCategories($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} blog categories");
            }
        }
    }

    private function seedAuthors($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
            $name = $faker->name . ' ' . ($i + 1);
            Author::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'biography' => $faker->paragraph,
                'image' => 'default/default_image.png',
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);

            if ($i % 100 === 0) {
                $this->info("Generated {$i} authors");
            }
        }
    }

    private function seedBooks($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
            $title = 'Book ' . ($i + 1) . ': ' . $faker->sentence;
            Book::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph,
                'isbn' => $faker->isbn13,
                'pages' => $faker->numberBetween(50, 1000),
                'published_date' => $faker->date(),
                'image' => 'default/default_image.png',
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);

            if ($i % 100 === 0) {
                $this->info("Generated {$i} books");
            }
        }
    }

    private function seedAreas($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
            $name = $faker->word . ' Area ' . ($i + 1);
            Area::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph,
                'status' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);

            if ($i % 100 === 0) {
                $this->info("Generated {$i} areas");
            }
        }
    }

    private function seedSlides($count, $faker)
    {
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} slides");
            }
        }
    }

    private function seedContactInfos($count, $faker)
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('contact_infos')) {
            $this->error('Bảng contact_infos không tồn tại.');
            return;
        }
        for ($i = 0; $i < $count; $i++) {
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
                $this->info("Generated {$i} contact infos");
            }
        }
    }
}
