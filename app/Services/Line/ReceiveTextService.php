<?php

namespace App\Service\Line;

use App\Models\TalkWord;
use Illuminate\Support\Facades\DB;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot;

class ReceiveTextService
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
    public function execute(TextMessage $event)
    {
        try {
            // ラインID
            $line_id = $event->getUserId();
            DB::beginTransaction();
            $input = [
                'user_id' => $line_id,
                'word' => $event->getText(),
            ];
            $talk_word_model = new TalkWord();
            $talk_word_model->fill($input)->save();
            DB::commit();
        } catch (Exeption $e) {
            DB::rollBack();
        }
        return $event->getText();
    }
}
