<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    protected $fillable = ['name', 'code', 'description', 'status'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'position_users');
    }
}
