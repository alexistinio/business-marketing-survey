<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'dim_roles';

    public function permission()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id')
            ->where('status_id', STATUS_ACTIVE);
    }
}
