<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public $fillable = ['name', 'image'];
    const UPDATED_AT = null;
    const CREATED_AT = null;
    const CACHE_KEY = 'CLASS_IMAGE';

    /**
     * bootstrap
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            \Cache::forget(self::CACHE_KEY);
        });
    }

    public static function all($column = [])
    {
        return \Cache::rememberForever(self::CACHE_KEY, function() {
            return parent::all();
        });
    }
}
