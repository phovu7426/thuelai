<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookCopy extends Model
{
    use HasFactory;

    protected $table = 'book_copies';

    protected $fillable = [
        'book_id',
        'code',
        'copy_number',
        'status'
    ];

    // Quan hệ với Books (Một sách có nhiều bản sao)
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
