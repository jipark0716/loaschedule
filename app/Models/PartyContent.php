<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartyContent extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function category()
    {
        return $this->hasOne(PartyContentCategory::class, 'id', 'category_id');
    }

    public function getFullNameAttribute()
    {
        return $this->category->name.' '.$this->name;
    }
}
