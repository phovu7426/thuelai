<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookCategory extends Pivot
{
    use HasFactory;

    protected $table = 'book_categories';

    protected $fillable = [
        'book_id',
        'category_id'
    ];

    public $timestamps = true; // Nếu bảng có cột created_at và updated_at
}
