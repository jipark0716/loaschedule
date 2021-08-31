<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Builder};

class Character extends Model
{
    public $fillable = ['item_level', 'level', 'server', 'account_id', 'c_rest', 'g_rest', 'name', 'sequence', 'class'];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope('sequence', function(Builder $query) {
            $query->orderBy('sequence', 'desc');
        });
    }

    /**
     * week work 관계성
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function week()
    {
        return $this->hasMany(WeekWork::class, 'target_id', 'id')->where('type', 'account')->where('week', now()->addDays(-2)->format('YW'));
    }

    /**
     * day work 관계성
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function day()
    {
        return $this->hasMany(DayWork::class, 'character_id', 'id')->where('day', now()->format('YWw'));
    }

    public function getClassImageAttribute()
    {
        $class = Classes::all()->where('name', $this->class)->first();
        if ($class) {
            return $class->image;
        } else {
            return '';
        }
    }
}
