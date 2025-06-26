<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'google_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function can($permission, $arguments = []): bool
    {
        // Nếu user có quyền trực tiếp, trả về true
        if (parent::can($permission, $arguments)) {
            return true;
        }

        // Kiểm tra nếu quyền này có quyền cha nhiều cấp
        $perm = Permission::where('name', $permission)->with('parent')->first();
        while ($perm && $perm->parent) {
            $perm = $perm->parent;
            if (parent::can($perm->name, $arguments)) {
                return true;
            }
        }

        return false;
    }

    public function canAny($permissions, $arguments = []): bool
    {
        foreach ($permissions as $permission) {
            if ($this->can($permission, $arguments)) {
                return true;
            }
        }
        return false;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'position_users');
    }

    /**
     * Get the cart for the user.
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Get the orders for the user.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
