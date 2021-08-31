<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekWork extends Model
{
    public $fillable = ['content_id', 'target_id', 'week', 'type', 'step'];
    const UPDATED_AT = null;

    /**
     * bootstrap
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            if ($model->week == null) {
                $model->week = now()->addDays(-2)->format('YW');
            }
        });
    }

    public function scopeNow($query)
    {
        return $query->where('week', now()->addDays(-2)->format('YW'));
    }
}
