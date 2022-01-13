<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartyMember extends Model
{
    const UPDATED_AT = null;
    public $fillable = ['party_id', 'user_id', 'author_id', 'character_id', 'account_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = $model->author_id ?? \Auth::user()->getKey();
        });
    }

    public function character()
    {
        return $this->hasOne(Character::class, 'id', 'character_id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
