<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoneProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'client',
        'location',
        'province',
        'region',
        'budget',
        'completed_date',
        'main_image',
        'gallery',
        'status',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'gallery' => 'array',
        'completed_date' => 'date',
        'is_featured' => 'boolean',
    ];

    const REGION_NORTH = 'north'; // Miền Bắc
    const REGION_CENTRAL = 'central'; // Miền Trung
    const REGION_SOUTH = 'south'; // Miền Nam

    public function getRegionTextAttribute(): string
    {
        return match($this->region) {
            self::REGION_NORTH => 'Miền Bắc',
            self::REGION_CENTRAL => 'Miền Trung',
            self::REGION_SOUTH => 'Miền Nam',
            default => 'Khác',
        };
    }

    public function getBudgetFormattedAttribute(): string
    {
        if (!$this->budget) {
            return 'Liên hệ';
        }
        
        return number_format($this->budget, 0, ',', '.') . ' đ';
    }
} 