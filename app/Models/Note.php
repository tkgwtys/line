<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Note extends Model
{
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id',
        'user_id',
        'course_id',
        'note_contents',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
