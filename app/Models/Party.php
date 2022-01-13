<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Builder};

class Party extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;
    public $dates = ['start_at'];
    public $fillable = ['name', 'content_id', 'start_at', 'author_id', 'guild_id', 'members'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->author_id = $query->author_id ?? \Auth::id();
            $query->guild_id = $query->guild_id ?? \Auth::user()->guild_id;
            $query->members = $query->members ?? $query->content->members;
        });
    }

    protected static function booted()
    {
        static::addGlobalScope('guild', function (Builder $builder) {
            $builder->where('guild_id', \Auth::user()->guild_id);
        });
    }

    public function content()
    {
        return $this->hasOne(PartyContent::class, 'id', 'content_id')->with('category');
    }

    public function user()
    {
        return $this->hasManyThrough(
            User::class,
            PartyMember::class,
            'party_id',
            'id',
            'id',
            'user_id'
        );
    }

    public function account()
    {
        return $this->hasManyThrough(
            Account::class,
            PartyMember::class,
            'party_id',
            'id',
            'id',
            'account_id'
        );
    }

    public function character()
    {
        return $this->hasManyThrough(
            Character::class,
            PartyMember::class,
            'party_id',
            'id',
            'id',
            'character_id'
        );
    }

    public function member()
    {
        return $this->hasMany(PartyMember::class, 'party_id', 'id');
    }
}
