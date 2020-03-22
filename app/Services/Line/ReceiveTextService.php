<?php

namespace App\Service\Line;

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
        return $event->getText();
    }
}
