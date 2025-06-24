<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'phone', 'birth_date', 'gender'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
