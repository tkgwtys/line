<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerImage extends Model
{
    protected $table = 'player_images';

    protected $fillable = [
        'player_id',
        'file_name',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
