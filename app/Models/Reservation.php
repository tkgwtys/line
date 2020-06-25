<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';

    protected $fillable = [
        'reservation_id',
        'user_id',
        'player_id',
        'course_id',
        'store_id',
        'status',
        'category',
        'reserved_at',
        'created_at',
        'updated_at',
    ];

    public static $status = [
        10 => '申請中',
        20 => 'キャンセル',
        30 => '確定',
    ];

    protected $dates = ['deleted_at'];

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
        return DB::table($this->table)
            ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
            ->leftJoin('courses', 'reservations.course_id', '=', 'courses.id')
            ->whereBetween('reserved_at', [$start, $end])
            ->whereNull('reservations.deleted_at')
            ->get();
    }
}
