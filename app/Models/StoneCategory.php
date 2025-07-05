<?php

namespace App\Models;

use App\Http\Controllers\Stone\HomeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoneCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'description',
        'image',
        'parent_id',
        'status',
        'order'
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(StoneCategory::class, 'parent_id')
            ->withDefault(['name' => 'N/A']);
    }

    public function children(): HasMany
    {
        return $this->hasMany(StoneCategory::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(StoneProduct::class, 'stone_category_id');
    }
} 