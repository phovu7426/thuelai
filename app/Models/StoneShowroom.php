<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoneShowroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'address',
        'province',
        'phone',
        'email',
        'hotline',
        'contact_person',
        'google_map',
        'image',
        'status',
        'order'
    ];
} 