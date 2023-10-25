<?php

namespace App\Models;

use App\Services\SubscriptionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dim_users';

    protected $fillable = [
        'role_id',
        'name',
        'username',
        'email',
        'phone_number',
        'voucher',
        'password',
        'status_id',
        'deleted_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function details()
    {
        return $this->hasOne(UserDetails::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function groups()
    {
        return $this->hasMany(UserGroup::class, 'user_id')
            ->where('status_id', STATUS_ACTIVE);
    }

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'role_id')
            ->where('status_id', STATUS_ACTIVE);
    }

    public function accesses()
    {
        return $this->permissions->map->access->flatten()->pluck('name')->unique();
    }

    public function following()
    {
        return $this->hasMany(UserFollow::class, 'user_id')
            ->where('status_id', STATUS_ACTIVE);
    }

    public function followers()
    {
        return $this->hasMany(UserFollow::class, 'following_id')
            ->where('status_id', STATUS_ACTIVE);
    }

    public function points()
    {
        return $this->hasOne(Point::class);
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    public function latestSubscription()
    {
        $subscription = new SubscriptionService();

        if ($subscription->hasCurrentSubscription($this->id)) {
            return $subscription->hasCurrentSubscription($this->id);
        }

        return null;
    }

    public function hasRole($roleName = '')
    {
        if ($this->role->name === $roleName) {
            return true;
        }

        return false;
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id_from');
    }
}
