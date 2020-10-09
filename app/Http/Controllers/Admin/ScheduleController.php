<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Player;
use App\Models\Reservation;
use App\Models\ReservationMemo;
use App\Models\Schedule;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * スケジュール管理
 * Class ScheduleController
 * @package App\Http\Controllers\Admin
 */
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 開始日
        $start_date = !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->toDateString();
        // 開始月
        $start_month = Carbon::parse($start_date)->format('Y年m月');
        // 件数
        $day_count = !empty($request->get('day_count')) ? $request->get('day_count') : 7;
        // 本日リンク
        $back_link = '/admin/schedule?start_date=' . Carbon::parse($start_date)->addDays(-($day_count + 1))->toDateString() . '&day_count=' . $day_count;
        $next_link = '/admin/schedule?start_date=' . Carbon::parse($start_date)->addDays(($day_count + 1))->toDateString() . '&day_count=' . $day_count;
        $today_link = '/admin/schedule';
        // 時間
        $time_array = Reservation::getOpenTimeArray();
        // トレーナ全員
        $player_array = User::where('level', 20)->get();
        // 件数
        for ($i = 0; $i <= $day_count; $i++) {
            //日付と曜日の取得
            $days_array[$i] = Carbon::parse($start_date)->addDay($i)->format('Y-m-d');
            $days_array_format[$i] = Carbon::parse($start_date)->addDay($i)->isoFormat('ddd D');
            //曜日番号の取得
            $days_number_array[$i] = Carbon::parse($start_date)->addDay($i)->dayOfWeekIso;
        }
        // コース
        $courses = Course::all();
        // 友達一覧
        $users = User::getUsers(10);
        // 店舗一覧
        $stores = Store::all();
        // 備考欄一覧
        $reservation_memos = ReservationMemo::all();
        // 予約一覧
        $reservation = new Reservation();
        $reservations = $reservation->getReservation($start_date, last($days_array), '', 1);
        //print_r($reservations);exit;
        // 未確定合計
        $unsettled = Reservation::where('status', 10)->where('reservation_sort', 1)->count();
        // view
        return view('admin.schedule.index',
            compact(
                'courses',
                'time_array',
                'player_array',
                'days_array',
                'days_array_format',
                'days_number_array',
                'user_level',
                'reservations',
                'users',
                'start_month',
                'stores',
                'back_link',
                'next_link',
                'today_link',
                'unsettled',
                'reservation_memos'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
