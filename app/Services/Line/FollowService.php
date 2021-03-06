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
            Log::debug($profile);
            // ユーザーチェック
            $user = User::where('id', $line_id)->first();
            if (!$user) {
                $user_model = new User();
                $input = [
                    'id' => $line_id,
                    'name' => $profile['displayName'],
                    'pictureUrl' => $profile['pictureUrl'],
                ];
                $user_model->fill($input)->save();
                Log::info('新規フォロー処理成功');
            } else {
                if (is_null($user->blocked_at)) {
                    $user_model = User::find($line_id);
                    $user_model->blocked_at = Carbon::now();
                    $user_model->pictureUrl = $profile['pictureUrl'];
                    $user_model->save();
                } else {
                    $user_model = User::find($line_id);
                    $user_model->blocked_at = null;
                    $user_model->pictureUrl = $profile['pictureUrl'];
                    $user_model->save();
                }
            }
            DB::commit();
            return true;
        } catch (Exeption $e) {
            DB::rollBack();
            return false;
        }
    }
}
