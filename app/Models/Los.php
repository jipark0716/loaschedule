<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Los extends Model
{
    public $fillable = ['character_id', 'rest', 'type', 'date'];
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
