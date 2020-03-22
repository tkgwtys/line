<?php

namespace App\Http\Controllers;

use App\Service\Line\ReceiveTextService;
use App\Services\Line\ReceiveLocationService;
use App\Services\Line\FollowService;
use App\Services\Line\UnFollowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Event\MessageEvent\LocationMessage;
use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\Event\FollowEvent;
use LINE\LINEBot\Event\UnfollowEvent;

class LineBotController extends Controller
{
    public function hello()
    {
        Log::debug('成功');
    }

    public function callback(Request $request)
    {
        $bot = app('line-bot');

        $signature = $request->header('x-line-signature');
        if (!LINEBot\SignatureValidator::validateSignature($request->getContent(), config('app.line.channel_secret'), $signature)) {
            abort(400);
        }

        $events = $bot->parseEventRequest($request->getContent(), $signature);
        foreach ($events as $event) {
            $reply_token = $event->getReplyToken();
            $reply_message = 'その操作はサポートしてません。.[' . get_class($event) . '][' . $event->getType() . ']';

            switch (true) {
                /**
                 * 登録
                 */
                case $event instanceof FollowEvent:
                    $service = new FollowService($bot);
                    $reply_message = $service->execute($event) ? '友達登録されたからLINE ID引っこ抜くわ' : '友達登録されたけど処理に失敗したから何もしないよ';
                    break;
                /**
                 * Text
                 */
                case $event instanceof TextMessage:
                    $service = new ReceiveTextService($bot);
                    $reply_message = $service->execute($event);
                    break;
                /**
                 * 現在位置
                 */
                case $event instanceof LocationMessage:
                    $service = new ReceiveLocationService($bot);
                    $reply_message = $service->execute($event);
                    break;
                case $event instanceof PostbackEvent:
                    Log::debug('PostBackEvent処理');
                    break;
                case $event instanceof UnfollowEvent:
                    $service = new UnFollowService($bot);
                    $reply_message = $service->execute($event) ? 'ブロックされました' : 'ブロックされたけど処理失敗';
                    break;
                default:
                    $body = $event->getEventBody();
                    logger()->warning('Unknown event. [' . get_class($event) . ']', compact('body'));
            }
            $bot->replyText($reply_token, $reply_message);
        }
    }
}
