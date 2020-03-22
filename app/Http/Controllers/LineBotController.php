<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use ReflectionException;

class LineBotController extends Controller
{
    public function hello()
    {
        Log::debug('成功');
    }

    /**
     * @param Request $request
     * @throws LINEBot\Exception\InvalidEventRequestException
     * @throws LINEBot\Exception\InvalidSignatureException
     * @throws ReflectionException
     */
    public function callback(Request $request)
    {
        $httpClient = new CurlHTTPClient(config('app.line.access_token'));
        $lineBot = new LINEBot($httpClient, ['channelSecret' => config('app.line.channel_secret')]);

        $signature = $request->header('x-line-signature');

        if (!$lineBot->validateSignature($request->getContent(), $signature)) {
            Log::debug('Invalid signature');
            abort(400, 'Invalid signature');
        }
        $events = $lineBot->parseEventRequest($request->getContent(), $signature);

        foreach ($events as $event) {
            if (!($event instanceof TextMessage)) {
                Log::debug('Non text message has come');
                continue;
            }

            $replyToken = $event->getReplyToken();
            $replyText = $event->getText();
            $lineBot->replyText($replyToken, $replyText);
        }
    }
}
