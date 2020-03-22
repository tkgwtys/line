<?php

namespace App\Services\Line;

use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\LocationMessage;

class ReceiveLocationService
{
    private $bot;

    /**
     * ReceiveLocationService constructor.
     * @param LINEBot $bot
     */
    public function __construct(LineBot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @param LocationMessage $event
     * @return string
     */
    public function execute(LocationMessage $event)
    {
        return 'あなたの現在地 ' . $event->getAddress();
    }


}
