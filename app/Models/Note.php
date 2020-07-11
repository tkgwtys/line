<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    use Notifiable;
    use SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'user_id',
        'course_id',
        'note_contents',
    ];

    protected $dates = [
        'deleted_at'
    ];


}
