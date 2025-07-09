<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoneContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read',
        'mail_sent',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'mail_sent' => 'boolean',
    ];
} 