<?php

namespace App\Services\Line;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\UnfollowEvent;
use \Illuminate\Support\Facades\DB;

class UnFollowService
{
    private $bot;

    /**
     * FollowService constructor.
     * @param LINEBot $bot
     */
    public function __construct(LINEBot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @param UnfollowEvent $event
     * @return bool
     */
    public function execute(UnfollowEvent $event)
    {
        try {
            DB::beginTransaction();
            $line_id = $event->getUserId();
            $user_model = User::find($line_id);
            $user_model->blocked_at = Carbon::now();
            $user_model->save();
            DB::commit();
            Log::info('ブロック処理成功');
            return true;
        } catch (Exeption $e) {
            DB::rollBack();
            return false;
        }
    }
}
