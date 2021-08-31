<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayWork extends Model
{
    public $fillable = ['content', 'character_id', 'day', 'before_rest'];
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
            if ($model->day == null) {
                $model->day = now()->format('YWw');
            }
        });
    }

    public function scopeNow($query)
    {
        return $query->where('day', now()->format('YWw'));
    }
}
