<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'fct_user_details';

    protected $fillable = [
        'user_id',
        'gender',
        'birthdate',
        'phone_no',
        'about_me',
        'profile',
        'background_image',
        'website_link',
    ];
}
