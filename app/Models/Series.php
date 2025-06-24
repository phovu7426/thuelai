<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'status'
    ];

    // Quan hệ 1-n với Books (Một series có nhiều sách)
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
