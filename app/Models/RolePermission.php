<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'fct_menu_role_permission';

    protected $fillable = [
        'role_id',
        'permission_id',
        'status_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')
            ->where('status_id', STATUS_ACTIVE);
    }

    public function access()
    {
        return $this->hasOne(MenuPermission::class, 'id', 'permission_id')
            ->where('status_id', STATUS_ACTIVE);
    }
}
