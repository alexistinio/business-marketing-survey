<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model
{
    use HasFactory;

    protected $table = 'fct_menu_permission';

    protected $fillable = [
        'menu_id',
        'permission',
        'name',
        'text',
        'status_id',
    ];
}
