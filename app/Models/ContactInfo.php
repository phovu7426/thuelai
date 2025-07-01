<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';
    protected $fillable = [
        'address',
        'phone',
        'email',
        'working_time',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'map_embed'
    ];
}
