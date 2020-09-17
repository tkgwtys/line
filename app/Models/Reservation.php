<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * @param int $status
     * @return string
     */
    public static function getStatus($status = 10)
    {
        return self::$status[$status];
    }

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
            ->leftJoin('stores', 'reservations.store_id', '=', 'stores.id')
            ->select(
                'users.*',
                'courses.*',
                'reservations.*',
                'stores.name as store_name'
            )
            ->whereBetween('reserved_at', [$start, $end])
            ->whereNull('reservations.deleted_at')
            ->get();
    }

    /**
     * トレーナーの選択された日の空いてない時間を取得
     * @param $playerId
     * @param $startTime
     * @param $endTime
     */
    public static function getUserReservationTimes($playerId, $startTime, $endTime)
    {
        $new_times = [];
        // 予約時間があるか
        $reservationTimes = DB::table('reservations')
            ->where('player_id', '=', $playerId)
            ->where('status', '=', 30)
            ->whereNull('reservations.deleted_at')
            ->whereBetween('reserved_at', [$startTime, $endTime])
            ->select(DB::raw('DATE_FORMAT(reservations.reserved_at, "%H:%i") as reserved_at'))
            ->get();
        if (count($reservationTimes) > 0) {
            foreach (Reservation::getOpenTimeArray() as $h => $time) {
                foreach ($time as $t) {
                    foreach ($reservationTimes as $rTime) {
                        if ($t == $rTime->reserved_at) {
                            break;
                        }
                    }
                    if ($t != $rTime->reserved_at) {
                        $new_times[$h][] = $t;
                    }
                }
            }
        } else {
            $new_times = Reservation::getOpenTimeArray();
        }
        return $new_times;
    }

    /**
     * 一人のユーザー予約一覧
     * @param $user_id
     */
    public
    static function getUserReservations($user_id)
    {
        $now = Carbon::now();
        return DB::table('reservations')
            ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
            ->leftJoin('stores', 'reservations.store_id', '=', 'stores.id')
            ->leftJoin('courses', 'reservations.course_id', '=', 'courses.id')
            ->select(
                'reservations.reservation_id',
                'reservations.user_id as reservations_user_id',
                'reservations.player_id as reservations_player_id',
                'reservations.status as reservations_status',
                'reservations.category as reservations_category',
                'reservations.course_id as reservations_course_id',
                'reservations.store_id as reservations_store_id',
                'reservations.status as reservations_status',
                DB::raw('DATE_FORMAT(reservations.reserved_at, "%Y年%m月%d日 %H:%i") as reservations_reserved_at'),
                'courses.name as courses_name',
                'courses.price as courses_price',
                'courses.total_price as courses_total_price',
                'courses.month_count as courses_month_count',
                'courses.course_time as courses_course_time',
                'courses.description as courses_description',
                'stores.name as stores_name',
                'stores.address as stores_address',
                'stores.tel as stores_tel',
                'stores.url as stores_url',
                'stores.business_hours as stores_business_hours',
                'users.sei as player_sei',
                'users.mei as player_mei',
                'users.sei as user_sei',
                'users.mei as user_mei'
            )->where([
                ['user_id', '=', $user_id],
                ['reserved_at', '>=', $now]
            ])->whereNull('reservations.deleted_at')
            ->get();
    }

    /**
     * 予約IDで取得
     * @param $reservation_id
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public
    static function findByReservationId($reservation_id)
    {
        return DB::table('reservations')
            ->leftJoin('users', 'reservations.player_id', '=', 'users.id')
            ->leftJoin('stores', 'reservations.store_id', '=', 'stores.id')
            ->leftJoin('courses', 'reservations.course_id', '=', 'courses.id')
            ->select(
                'reservations.reservation_id',
                'reservations.user_id as reservations_user_id',
                'reservations.player_id as reservations_player_id',
                'reservations.status as reservations_status',
                'reservations.category as reservations_category',
                'reservations.course_id as reservations_course_id',
                'reservations.store_id as reservations_store_id',
                'reservations.status as reservations_status',
                DB::raw('DATE_FORMAT(reservations.reserved_at, "%Y年%m月%d日 %H:%i") as reservations_reserved_at'),
                'courses.name as courses_name',
                'courses.price as courses_price',
                'courses.total_price as courses_total_price',
                'courses.month_count as courses_month_count',
                'courses.course_time as courses_course_time',
                'courses.description as courses_description',
                'stores.name as stores_name',
                'stores.address as stores_address',
                'stores.tel as stores_tel',
                'stores.url as stores_url',
                'stores.business_hours as stores_business_hours',
                'users.sei as player_sei',
                'users.mei as player_mei',
                'users.sei as user_sei',
                'users.mei as user_mei'
            )->where([
                ['reservation_id', '=', $reservation_id],
            ])->whereNull('reservations.deleted_at')
            ->first();
    }

    /**
     * @param $date
     */
    public static function findByReservationMonth($date)
    {
    }
}
