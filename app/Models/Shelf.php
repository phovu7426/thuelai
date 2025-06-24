<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shelf extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'area_id',
        'code',
        'name',
        'capacity',
        'description',
        'status',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

//    public function books()
//    {
//        return $this->hasMany(Books::class);
//    }
}

