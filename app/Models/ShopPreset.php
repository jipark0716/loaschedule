<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ShopPreset extends Model
{
    public $fillable = ['user_id', 'name', 'cate', 'grade', 'quality', 'etc1', 'etc2', 'etc3', 'etc4', 'max_price'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->user_id) {
                $model->user_id = \Auth::user()->getKey();
            }
        });
    }
    public function getProduct()
    {

    }
}
