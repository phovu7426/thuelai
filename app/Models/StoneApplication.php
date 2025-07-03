<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StoneApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'image',
        'type',
        'status',
        'order'
    ];

    const TYPE_EXTERIOR = 1; // Ngoại thất
    const TYPE_INTERIOR = 2; // Nội thất
    const TYPE_ARTSTONE = 3; // Đá mỹ nghệ

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            StoneProduct::class,
            'stone_product_applications',
            'stone_application_id',
            'stone_product_id'
        )->withTimestamps();
    }

    public function getTypeTextAttribute(): string
    {
        return match($this->type) {
            self::TYPE_EXTERIOR => 'Ngoại thất',
            self::TYPE_INTERIOR => 'Nội thất',
            self::TYPE_ARTSTONE => 'Đá mỹ nghệ',
            default => 'Khác',
        };
    }
} 