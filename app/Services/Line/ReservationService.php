<?php

namespace App\Services\Line;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot;

class ReservationService
{
    private $bot;

    /**
     * ReceiveTextService constructor.
     * @param LINEBot $bot
     */
    public function __construct(LINEBot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * 登録
     * @param TextMessage $event
     * @return string
     */
    public function getReservation(TextMessage $event)
    {
        $message = '';
        $user_id = $event->getUserId();
        Log::debug($user_id);
        $now = Carbon::today();
        $reservations = DB::table('reservations')
            ->leftJoin('users', 'reservations.player_id', '=', 'users.id')
            ->leftJoin('users as players', 'reservations.user_id', '=', 'players.id')
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
                'users.sei as users_sei',
                'users.mei as users_mei',
                'users.sei as players_sei',
                'users.mei as players_mei'
            )->where([
                ['user_id', '=', $user_id],
                ['reserved_at', '>=', $now]
            ])->whereNull('reservations.deleted_at')
            ->orderBy('reservations_reserved_at', 'ASC')
            ->get();
        Log::debug($reservations);

        if (count($reservations) > 0) {
            foreach ($reservations as $key => $reservation) {
                $message .= '日時：' . $reservation->reservations_reserved_at . "\n";
                $message .= 'トレーナ：' . $reservation->users_sei . $reservation->users_mei . "\n";
                $message .= '店舗：' . $reservation->stores_name . "\n";
                $message .= 'ステータス：' . Reservation::$status[$reservation->reservations_status] . "\n";
                if (count($reservations) != $key + 1) {
                    $message .= "-------------------\n";
                }
            }
            return $message;
        }
        return '現在、お客様のご予約はございません。';


//        if (count($reservations) > 0) {
//            foreach ($reservations as $key => $reservation) {
//                $message .= $reservation->reservations_reserved_at . ' ' . Reservation::$status[$reservation->reservations_status];
//                Log::debug($message);
//                if (count($reservations) != $key + 1) {
//                    $message .= "\n";
//                }
//            }
//            $actions = [
//                new UriTemplateActionBuilder("変更・キャンセル",
//                    config('app.url') . 'user/edit'
//                ),
//            ];
//            $button = new ButtonTemplateBuilder('予約確認', $message, null, $actions);
//            $resultMessage = new TemplateMessageBuilder('Finish generate playlist', $button);
//            $bot->replyMessage($reply_token, $resultMessage);
//        }
//        $bot->replyMessage($reply_token, new TextMessageBuilder('現在、お客様のご予約はございません。'));
    }
}
