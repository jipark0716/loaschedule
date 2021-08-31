<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCosplayer extends Model
{
    public $fillable = ['account_id', 'comment'];
    const UPDATED_AT = null;
}
