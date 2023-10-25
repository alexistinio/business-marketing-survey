<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'dim_surveys';

    protected $fillable = [
        'user_id',
        'status_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'is_private',
        'deleted_at',
    ];

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groups()
    {
        return $this->hasMany(SurveyCategory::class, 'survey_id')
            ->where('deleted_at', null)
            ->where('status_id', STATUS_ACTIVE);
    }

    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id')->where('deleted_at', null);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'survey_id');
    }

    public function comments()
    {
        return $this->hasMany(SurveyComment::class, 'survey_id');
    }

    public function scopePublic($query)
    {
        return $query->whereIn('is_private', [0, null]);
    }

    public function scopePrivate($query)
    {
        return $query->where('is_private', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null)
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('end_date', '>=', date('Y-m-d'));
    }
}
