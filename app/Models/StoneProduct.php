<?php

namespace App\Models;

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
        'short_description',
        'description',
        'specifications',
        'main_image',
        'gallery',
        'price',
        'sale_price',
        'stone_category_id',
        'stone_material_id',
        'stone_surface_id',
        'is_featured',
        'status',
        'order'
    ];

    protected $casts = [
        'gallery' => 'array',
        'specifications' => 'array',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(StoneCategory::class, 'stone_category_id')
            ->withDefault(['name' => 'N/A']);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(StoneMaterial::class, 'stone_material_id')
            ->withDefault(['name' => 'N/A']);
    }

    public function surface(): BelongsTo
    {
        return $this->belongsTo(StoneSurface::class, 'stone_surface_id')
            ->withDefault(['name' => 'N/A']);
    }

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(
            StoneApplication::class,
            'stone_product_applications',
            'stone_product_id',
            'stone_application_id'
        )->withTimestamps();
    }
} 