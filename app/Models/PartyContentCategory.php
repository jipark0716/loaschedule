<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Builder};

class PartyContentCategory extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected static function booted()
    {
        static::addGlobalScope('sequence', function (Builder $builder) {
            $builder->orderBy('sequence');
        });
    }

    public function content()
    {
        return $this->hasMany(PartyContent::class, 'category_id', 'id');
    }
}
