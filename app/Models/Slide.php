<?php

namespace App\Models;

use App\Http\Controllers\Stone\HomeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'status'
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
}
