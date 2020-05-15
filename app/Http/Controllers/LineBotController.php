<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Service\Line\ReceiveTextService;
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
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;

class LineBotController extends Controller
{
    public function hello()
    {
        Log::debug('成功');
    }

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
            switch (true) {
                /**
                 * 登録
                 */
                case $event instanceof FollowEvent:
                    Log::debug('FollowEvent');
                    $service = new FollowService($bot);
                    $service->execute($event);// ? '友だち追加ありがとうございます(happy) 気になるトレーナーを見つけて予定をいれちゃおう！' : '友達登録されたけど処理に失敗したから何もしないよ';

                    $columns = []; // カルーセル型カラムを3つ追加する配列

                    foreach ($this->trainerArray() as $val) {
                        // カルーセルに付与するボタンを作る
                        $action = new UriTemplateActionBuilder(
                            "予約する",
                            config('app.url') . 'register?uid=' . $event->getUserId());
                        // カルーセルのカラムを作成する
                        $column = new CarouselColumnTemplateBuilder(
                            $val['name'],
                            $val['self_introduction'],
                            $val['image'], [$action]);
                        $columns[] = $column;
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
                        $columns = []; // カルーセル型カラムを3つ追加する配列

                        foreach ($this->trainerArray() as $val) {
                            // カルーセルに付与するボタンを作る
                            $action = new UriTemplateActionBuilder(
                                "予約する",
                                config('app.url') . 'register?uid=' . $event->getUserId());
                            $action2 = new UriTemplateActionBuilder(
                                "プロフィール",
                                config('app.url') . 'register?uid=' . $event->getUserId());
                            // カルーセルのカラムを作成する
                            $column = new CarouselColumnTemplateBuilder(
                                $val['name'],
                                $val['self_introduction'],
                                $val['image'], [$action, $action2]);
                            $columns[] = $column;
                        }
                        // カラムの配列を組み合わせてカルーセルを作成する
                        $carousel = new CarouselTemplateBuilder($columns);
                        // カルーセルを追加してメッセージを作る
                        $carousel_message = new TemplateMessageBuilder("トレーナ選択", $carousel);
                        $bot->replyMessage($event->getReplyToken(), $carousel_message);
                    } else {
                        $bot->replyText($reply_token, $reply_message);
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

    private function trainerArray()
    {

        //データの取得
        $players = Player::all();
        //受け渡し用の配列作成
        $players_multi_data =[];
        //データ用配列作成
        $players_data =[];
        //Player::all()のデータを$players_multi_dataに代入
        foreach($players as $player){
            //'name'キー -> sei + mei
            $players_data['name'] = $player['sei'].$player['mei'];
            //'self_introduction'キー -> self_introduction
            $players_data['self_introduction'] = $player['self_introduction'];
            //image取得
            $image = asset('storage/images/players/' . $player['id'].'/original.jpg');
            $players_data['image'] = $image;

            //連想配列$players_dataを代入
            $players_multi_data[]=$players_data;
        }
        return $players_multi_data;
    }
}

