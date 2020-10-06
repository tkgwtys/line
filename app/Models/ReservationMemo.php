<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class ReservationMemo extends Model
{
    use Notifiable;
    protected $table = 'reservation_memos';

    protected $fillable = [
        'reservation_id',
        'reservation_memo',
    ];
}
