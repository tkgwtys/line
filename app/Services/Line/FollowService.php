<?php

namespace App\Services\Line;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\FollowEvent;
use \Illuminate\Support\Facades\DB;

class FollowService
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
     * @param FollowEvent $event
     * @return bool
     */
    public function execute(FollowEvent $event)
    {
        try {
            DB::beginTransaction();
            // ラインID
            $line_id = $event->getUserId();
            $rsp = $this->bot->getProfile($line_id);
            if (!$rsp->isSucceeded()) {
                logger()->info('failed to get profile. skip processing.');
                return false;
            }
            // プロフィール取得
            $profile = $rsp->getJSONDecodedBody();
            // ユーザーチェック
            $user = User::where('id', $line_id)->first();
            Log::debug($user);
            if (!$user) {
                $user_model = new User();
                $user_model->id = $line_id;
                $user_model->display_name = $profile['displayName'];
                $user_model->picture_url = $profile['pictureUrl'];
                $user_model->save();
            } else {
                if (is_null($user->blocked_at)) {
                    $user_model = User::find($line_id);
                    $user_model->blocked_at = Carbon::now();
                    $user_model->save();
                } else {
                    $user_model = User::find($line_id);
                    $user_model->display_name = $profile['displayName'];
                    $user_model->picture_url = $profile['pictureUrl'];
                    $user_model->blocked_at = null;
                    $user_model->save();
                }
            }
            DB::commit();
            return true;
        } catch (Exeption $e) {
            DB::rollBack();
            Log::info('新規フォロー処理失敗');
            return false;
        }
    }
}
