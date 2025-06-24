<?php

namespace Database\Seeders;

use App\Models\StoneCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Danh mục chính
        $mainCategories = [
            [
                'name' => 'Đá ốp lát',
                'description' => 'Các sản phẩm đá ốp lát cho công trình',
                'code' => 'DA-OP-LAT',
                'image' => 'stone_categories/da-op-lat.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Đá mỹ nghệ',
                'description' => 'Các sản phẩm đá mỹ nghệ, đá điêu khắc',
                'code' => 'DA-MY-NGHE',
                'image' => 'stone_categories/da-my-nghe.jpg',
                'order' => 2,
            ],
        ];

        // Danh mục con của Đá ốp lát
        $stoneTileSubCategories = [
            [
                'name' => 'Đá ốp lát nội thất',
                'description' => 'Các sản phẩm đá ốp lát sử dụng trong nội thất',
                'code' => 'DA-NOI-THAT',
                'image' => 'stone_categories/da-noi-that.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Đá ốp lát ngoại thất',
                'description' => 'Các sản phẩm đá ốp lát sử dụng trong ngoại thất',
                'code' => 'DA-NGOAI-THAT',
                'image' => 'stone_categories/da-ngoai-that.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Đá bó vỉa',
                'description' => 'Các sản phẩm đá bó vỉa',
                'code' => 'DA-BO-VIA',
                'image' => 'stone_categories/da-bo-via.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Đá cubic',
                'description' => 'Các sản phẩm đá cubic',
                'code' => 'DA-CUBIC',
                'image' => 'stone_categories/da-cubic.jpg',
                'order' => 4,
            ],
        ];

        // Danh mục con của Đá mỹ nghệ
        $stoneArtSubCategories = [
            [
                'name' => 'Đá mỹ nghệ lăng mộ',
                'description' => 'Các sản phẩm đá mỹ nghệ lăng mộ',
                'code' => 'DA-LANG-MO',
                'image' => 'stone_categories/da-lang-mo.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Đá mỹ nghệ đình chùa',
                'description' => 'Các sản phẩm đá mỹ nghệ đình chùa',
                'code' => 'DA-DINH-CHUA',
                'image' => 'stone_categories/da-dinh-chua.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Đá mỹ nghệ nhà thờ',
                'description' => 'Các sản phẩm đá mỹ nghệ nhà thờ',
                'code' => 'DA-NHA-THO',
                'image' => 'stone_categories/da-nha-tho.jpg',
                'order' => 3,
            ],
        ];

        // Thêm danh mục chính
        $mainCategoryIds = [];
        foreach ($mainCategories as $category) {
            $newCategory = StoneCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'code' => $category['code'],
                'description' => $category['description'],
                'image' => $category['image'],
                'parent_id' => null,
                'status' => 1,
                'order' => $category['order'],
            ]);
            $mainCategoryIds[$category['name']] = $newCategory->id;
        }

        // Thêm danh mục con Đá ốp lát
        foreach ($stoneTileSubCategories as $category) {
            StoneCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'code' => $category['code'],
                'description' => $category['description'],
                'image' => $category['image'],
                'parent_id' => $mainCategoryIds['Đá ốp lát'],
                'status' => 1,
                'order' => $category['order'],
            ]);
        }

        // Thêm danh mục con Đá mỹ nghệ
        foreach ($stoneArtSubCategories as $category) {
            StoneCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'code' => $category['code'],
                'description' => $category['description'],
                'image' => $category['image'],
                'parent_id' => $mainCategoryIds['Đá mỹ nghệ'],
                'status' => 1,
                'order' => $category['order'],
            ]);
        }
    }
} 