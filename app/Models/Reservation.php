<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'player_id',
        'status',
        'category',
        'reserved_at',
    ];

    /**
     * 時間の配列を返す
     * @param int $start_h
     * @param int $end_h
     * @param int $tick
     * @return array
     */
    public static function getOpenTimeArray($start_h = 7, $end_h = 23, $tick = 15)
    {
        // 時間
        $time_array = [];
        for ($i = $start_h; $i <= $end_h; $i++) {
            for ($j = 0; $j <= 55; $j += $tick) {
                $time_array[$i][$j] = sprintf("%02d:%02d", $i, $j);
            }
        }
        return $time_array;
    }

    /**
     * 指定範囲での予約を取得する
     * @param $start
     * @param $end
     * @return \Illuminate\Support\Collection
     */
    public function getReservation($start, $end)
    {
        return DB::table($this->table)->whereBetween('reserved_at', [$start, $end])->get();
    }
}
