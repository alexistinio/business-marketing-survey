<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserGroup extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'fct_user_group';

    protected $fillable = [
        'user_id',
        'group_id',
        'status_id',
    ];

    public function group()
    {
        return $this->belongsTo(Category::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', STATUS_ACTIVE);
    }
}
