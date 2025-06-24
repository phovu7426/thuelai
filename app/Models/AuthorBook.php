<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AuthorBook extends Pivot
{
    use HasFactory;

    protected $table = 'author_books';

    protected $fillable = [
        'book_id',
        'author_id'
    ];

    public $timestamps = true; // Nếu bảng có timestamps
}
