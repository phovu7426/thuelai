<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'series_id',
        'code',
        'name',
        'volume',
        'isbn',
        'published_at',
        'publisher_id',
        'language',
        'page_count',
        'summary',
        'image',
        'status'
    ];

    // Quan hệ với Series
    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    // Quan hệ với Nhà xuất bản
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    // Quan hệ nhiều-nhiều với Authors
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_books');
    }

    // Quan hệ nhiều-nhiều với Categories
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    // Quan hệ 1-n với Books Copies
    public function copies(): HasMany
    {
        return $this->hasMany(BookCopy::class);
    }
}
