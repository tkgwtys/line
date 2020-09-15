<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Course;
use App\Models\Player;
use App\Models\Reservation;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $players = User::where('level', 20)->get();
        return view('admin.player.index', compact('players', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.player.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $path = public_path('storage/images/players');
        if (!(new Filesystem)->isDirectory($path)) {
            (new Filesystem)->makeDirectory($path, 0777, true);
        }
        // ファイル名ランダム作成
        $file_name = 'original.jpg';
        // POSTデーター取得
        $player = Player::create($request->all());
        // 画像を保存している
        $request->file('image')->storeAs('public/images/players/' . $player->id, $file_name);
        Image::make($request->file('image'))->resize(300, 300)->save('storage/images/players/' . $player->id . '/300x300.jpg');
        Image::make($request->file('image'))->resize(500, 500)->save('storage/images/players/' . $player->id . '/500x500.jpg');
        return redirect('/admin/player'); //->with('success', '新しいトレーナをを登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param int $player_id
     * @return Application|Factory|View
     */
    public function show(Request $request, $player_id)
    {
        // 開始日
        $start_date = !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->toDateString();
        // 開始月
        $start_month = Carbon::parse($start_date)->format('Y年m月');
        // 件数
        $day_count = !empty($request->get('day_count')) ? $request->get('day_count') : 7;
        // 本日リンク
        $today_link = '/admin/player/' . $player_id . '?start_date=' . Carbon::now()->toDateString() . '&day_count=' . $day_count;
        $next_week = '/admin/player/' . $player_id . '?start_date=' . Carbon::now()->toDateString() . '&day_count=' . $day_count;
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
            $days_number_array[$i]= Carbon::parse($start_date)->addDay($i)->dayOfWeekIso;
        }

        // コース
        $courses = Course::all();
        // プレイヤー１件取得
        $player = User::find($player_id);
        // 友達一覧
        $users = User::where('level', 10)->get();
        // 店舗一覧
        $stores = Store::all();
        // 予約一覧
        $reservation = new Reservation();
        $reservations = $reservation->getReservation($start_date, last($days_array));
        // view
        return view('admin.player.show',
            compact(
                'courses',
                'today_link',
                'player',
                'time_array',
                'player_array',
                'days_array',
                'days_array_format',
                'days_number_array',
                'user_level',
                'reservations',
                'users',
                'start_month',
                'stores')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user_level = User::getLevelAll();
        $player = User::find($id);
        return view('admin.player.edit', ['player' => $player, 'user_level' => $user_level]);
    }


    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $player = User::find($id);
        if (!$player) {
            return redirect('/admin/player');
        }
        if ($request->image) {
            $request->file('image')->storeAs('public/images/players/' . $player->id, 'original.jpg');
            Image::make($request->file('image'))->resize(300, 300)->save('storage/images/players/' . $player->id . '/300x300.jpg');
            Image::make($request->file('image'))->resize(500, 500)->save('storage/images/players/' . $player->id . '/500x500.jpg');
        }
        $player->sei = $request->sei;
        $player->mei = $request->mei;
        $player->sei_hira = $request->sei_hira;
        $player->mei_hira = $request->mei_hira;
        $player->level = $request->level;
        $player->self_introduction = $request->self_introduction;
        $player->save();
        return redirect('/admin/player');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $player_id = Player::find($id);
        $player_id->delete();
        return redirect('/admin/player');
    }
}
