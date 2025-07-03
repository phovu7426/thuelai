<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoneProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'stone_product_id',
        'path',
        'alt',
        'is_main',
        'order'
    ];

    /**
     * Lấy sản phẩm của hình ảnh này
     */
    public function product()
    {
        return $this->belongsTo(StoneProduct::class, 'stone_product_id');
    }
} 