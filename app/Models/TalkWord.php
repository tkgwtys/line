<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalkWord extends Model
{
    protected $fillable = [
        'user_id',
        'word',
    ];
}
