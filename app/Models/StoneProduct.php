<?php

namespace App\Models;

use App\Http\Controllers\Stone\HomeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StoneProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'stone_category_id',
        'stone_material_id',
        'stone_surface_id',
        'stone_color_id',
        'price',
        'sale_price',
        'discount_price',
        'discount_percent',
        'short_description',
        'description',
        'features',
        'origin',
        'size',
        'thickness',
        'hardness',
        'water_absorption',
        'heat_resistance',
        'is_featured',
        'is_new',
        'status',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'main_image',
        'gallery',
        'specifications'
    ];

    protected $casts = [
        'gallery' => 'array',
        'specifications' => 'array',
        'is_featured' => 'boolean',
    ];
    
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saved(function () {
            HomeController::clearHomeCache();
        });
        
        static::deleted(function () {
            HomeController::clearHomeCache();
        });
    }

    /**
     * Lấy danh mục của sản phẩm
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(StoneCategory::class, 'stone_category_id')
            ->withDefault(['name' => 'N/A']);
    }

    /**
     * Lấy chất liệu của sản phẩm
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(StoneMaterial::class, 'stone_material_id')
            ->withDefault(['name' => 'N/A']);
    }

    /**
     * Lấy bề mặt của sản phẩm
     */
    public function surface(): BelongsTo
    {
        return $this->belongsTo(StoneSurface::class, 'stone_surface_id')
            ->withDefault(['name' => 'N/A']);
    }

    /**
     * Lấy màu sắc của sản phẩm
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(StoneColor::class, 'stone_color_id');
    }

    /**
     * Lấy các hình ảnh của sản phẩm
     */
    public function images()
    {
        return $this->hasMany(StoneProductImage::class);
    }

    /**
     * Lấy các ứng dụng của sản phẩm
     */
    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(
            StoneApplication::class,
            'stone_product_applications',
            'stone_product_id',
            'stone_application_id'
        )->withTimestamps();
    }

    /**
     * Lấy các dự án sử dụng sản phẩm này
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(StoneProject::class, 'stone_project_products');
    }
} 