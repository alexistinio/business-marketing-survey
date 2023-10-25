<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'fct_subscriptions';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_timestamp',
        'end_timestamp',
        'purchase_timestamp',
        'status_id',
    ];

    protected $casts = [
        'start_timestamp' => 'datetime',
        'end_timestamp' => 'datetime',
        'purchase_timestamp' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }
}
