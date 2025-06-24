<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionUser extends Model
{
    protected $table = 'position_users';

    protected $fillable = ['user_id', 'position_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
