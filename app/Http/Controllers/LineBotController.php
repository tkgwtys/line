<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Line\ReceiveTextService;
use App\Services\Line\ReservationService;
use App\Services\Line\ReceiveLocationService;
use App\Services\Line\FollowService;
use App\Services\Line\UnFollowService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Event\MessageEvent\LocationMessage;
use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\Event\FollowEvent;
use LINE\LINEBot\Event\UnfollowEvent;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;

class LineBotController extends Controller
{
    /**
     * カルーセル作成
     * @param $player_id
     * @param $user_id
     * @param $name
     * @param $self_introduction
     * @param $image
     * @return CarouselColumnTemplateBuilder
     */
    private function createCarousel($player_id, $user_id, $name, $self_introduction, $image)
    {
//        $user = User::where('id', $user_id)->first();
//        Log::debug($user);
        // カルーセルに付与するボタンを作る
        $action = new UriTemplateActionBuilder(
            "予約する",
            config('app.url') . 'reservation/' . $player_id . '?uid=' . $user_id);
        // カルーセルのカラムを作成する
        $action2 = new UriTemplateActionBuilder(
            "プロフィール",
            config('app.url') . 'player/' . $player_id . '?uid=' . $user_id);
        $column = new CarouselColumnTemplateBuilder(
            $name,
            $self_introduction,
            $image, [$action, $action2]);
        return $column;
    }

    /**
     * 個人情報チェック
     * @param $user_id
     * @return bool
     */
    private function userInfoCheck($user_id)
    {
        $user = User::where('id', $user_id)->first();
        return $user->sei && $user->mei;
    }

    /**
     * コールバック
     * @param Request $request
     * @throws LINEBot\Exception\InvalidSignatureException
     */
    public function callback(Request $request)
    {
        Log::debug('1');
        $bot = app('line-bot');
        $signature = $request->header('x-line-signature');
        if (!LINEBot\SignatureValidator::validateSignature($request->getContent(), config('app.line.channel_secret'), $signature)) {
            abort(400);
        }
        Log::debug('2');
        $events = $bot->parseEventRequest($request->getContent(), $signature);
        foreach ($events as $event) {
            Log::debug('3');
            $reply_token = $event->getReplyToken();
            // $reply_message = 'その操作はサポートしてません。.[' . get_class($event) . '][' . $event->getType() . ']';
            Log::debug('4');
            $columns = []; // カルーセル型カラムを3つ追加する配列
            switch (true) {
                /**
                 * 登録
                 */
                case $event instanceof FollowEvent:
                    Log::debug('FollowEvent');
                    $service = new FollowService($bot);
                    $service->execute($event);// ? '友だち追加ありがとうございます(happy) 気になるトレーナーを見つけて予定をいれちゃおう！' : '友達登録されたけど処理に失敗したから何もしないよ';

                    foreach ($this->trainerArray() as $val) {
                        $columns[] = $this->createCarousel($val['player_id'], $event->getUserId(), $val['name'], $val['self_introduction'], $val['image']);
                    }
                    // カラムの配列を組み合わせてカルーセルを作成する
                    $carousel = new CarouselTemplateBuilder($columns);
                    // カルーセルを追加してメッセージを作る
                    $carousel_message = new TemplateMessageBuilder("トレーナ選択", $carousel);
                    $bot->replyMessage($event->getReplyToken(), $carousel_message);
                    break;
                /**
                 * Text
                 */
                case $event instanceof TextMessage:
                    Log::debug('TextMessage');
                    $service = new ReceiveTextService($bot);
                    $reply_message = $service->execute($event);
                    if ($event->getText() == 'トレーナー') {
                        foreach ($this->trainerArray() as $val) {
                            $columns[] = $this->createCarousel($val['player_id'], $event->getUserId(), $val['name'], $val['self_introduction'], $val['image']);
                        }
                        // カラムの配列を組み合わせてカルーセルを作成する
                        $carousel = new CarouselTemplateBuilder($columns);
                        // カルーセルを追加してメッセージを作る
                        $carousel_message = new TemplateMessageBuilder("トレーナ選択", $carousel);
                        $bot->replyMessage($event->getReplyToken(), $carousel_message);
                    } else if ($event->getText() == '設定') {
//                        // 「はい」ボタン
//                        $yes_post = new PostbackTemplateActionBuilder("はい", "page=1");
//                        // 「いいえ」ボタン
//                        $no_post = new PostbackTemplateActionBuilder("いいえ", "page=-1");
//                        // Confirmテンプレートを作る
//                        $confirm = new ConfirmTemplateBuilder("メッセージ", [$yes_post, $no_post]);
//                        // Confirmメッセージを作る
//                        $confirm_message = new TemplateMessageBuilder("メッセージのタイトル", $confirm);
//                        $bot->replyMessage($event->getReplyToken(), $confirm_message);

//                        $text = new TextMessageBuilder('https://www.yahoo.co.jp');
//                        $button = new LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder()
//                        $bot->replyMessage($reply_token, $text);

                        $this->userInfo($bot, $reply_token);
                    } else if ($event->getText() == '予約確認') {
                        Log::debug('予約確認');
                        $service = new ReservationService($bot);
                        $result_message = $service->getReservation($event);
                        $bot->replyMessage($reply_token, new TextMessageBuilder($result_message));
                    } else {
                        $bot->replyMessage($reply_token, $reply_message);
                    }
                    break;
                /**
                 * 現在位置
                 */
                case $event instanceof LocationMessage:
                    $service = new ReceiveLocationService($bot);
                    $reply_message = $service->execute($event);
                    $bot->replyText($reply_token, $reply_message);
                    break;
                /**
                 * ボタンの入力を受け取る
                 */
                case $event instanceof PostbackEvent:
                    Log::debug('PostBackEvent処理');
                    $query = $event->getPostbackData();
                    Log::debug($query);
                    break;
                /**
                 * ブロック
                 */
                case $event instanceof UnfollowEvent:
                    Log::debug('UnfollowEvent');
                    $service = new UnFollowService($bot);
                    $reply_message = $service->execute($event) ? 'ブロックされました' : 'ブロックされたけど処理失敗';
                    $bot->replyText($reply_token, $reply_message);
                    break;
                default:
                    // $body = $event->getEventBody();
                    // logger()->warning('Unknown event. [' . get_class($event) . ']', compact('body'));
            }
        }
    }

    /**
     * ユーザー情報入力
     * @param $bot
     * @param $reply_token
     * @param $event
     */
    private function userInfo($bot, $reply_token)
    {
        $actions = [
            new UriTemplateActionBuilder("入力フォームへ",
                config('app.url') . 'user/edit'
            ),
        ];
        $button = new ButtonTemplateBuilder('設定', '予約するためにはお客様情報を入力してください', null, $actions);
        $msg = new TemplateMessageBuilder('Finish generate playlist', $button);
        $bot->replyMessage($reply_token, $msg);
    }

    /**
     * @param $bot
     * @param $replyToken
     * @param $alertNativeText
     * @param $text
     * @param mixed ...$actions
     */
    private function replyConfirmTemplate($bot, $replyToken, $alertNativeText, $text, ...$actions)
    {
        $actionArray = [];
        if (count($actions) > 1) {
            foreach ($actions as $value) {
                array_push($actionArray, $value);
            }
            $builder = new TemplateMessageBuilder($alertNativeText, new ConfirmTemplateBuilder($text, $actionArray));
        } else {
            $builder = new TemplateMessageBuilder($alertNativeText, new ConfirmTemplateBuilder($text, $actions));
        }
        $response = $bot->replyMessage($replyToken, $builder);
        if (!$response->isSucceeded()) {
            Log::debug(json_encode($response));
//            error_log('## Failed! ' . $response->getHTTPStatus . ' ' . $response->getRawBody());
        }
    }

    /**
     * トレーナ取得
     * @return array
     */
    private function trainerArray()
    {
        //データの取得
        $players = User::where('level', 20)->get();
        //データ用配列作成
        $players_data = [];
        //Player::all()のデータを$players_multi_dataに代入
        foreach ($players as $key => $player) {
            //'name'キー -> sei + mei
            $players_data[$key]['player_id'] = $player['id'];
            $players_data[$key]['name'] = $player['sei'] . $player['mei'];
            //'self_introduction'キー -> self_introduction
            $players_data[$key]['self_introduction'] = $player['self_introduction'] || '';
            //image取得
            $image = asset('storage/images/users/' . $player['id'] . '/300x300.jpg?' . time());
            $players_data[$key]['image'] = $image;
        }
        return $players_data;
    }
}

