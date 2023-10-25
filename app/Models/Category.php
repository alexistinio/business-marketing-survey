<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'dim_categories';

    public function posts()
    {
        return $this->hasMany(SurveyCategory::class, 'category_id')
            ->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null);
    }

    public function users()
    {
        return $this->hasMany(UserGroup::class, 'group_id')
        ->where('status_id', STATUS_ACTIVE);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null);
    }
}
