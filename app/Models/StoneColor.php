<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoneColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'order'
    ];

    /**
     * Lấy các sản phẩm thuộc màu sắc này
     */
    public function products()
    {
        return $this->hasMany(StoneProduct::class);
    }
} 