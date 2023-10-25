<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $table = 'dim_plans';

    public function scopeActive($q) {
        return $q->where('status_id', STATUS_ACTIVE);
    }
}
