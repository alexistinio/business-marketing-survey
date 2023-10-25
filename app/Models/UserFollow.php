<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use HasFactory;

    protected $table = "fct_user_following";

    protected $fillable = [
        'user_id',
        'following_id',
        'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function following_user()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
