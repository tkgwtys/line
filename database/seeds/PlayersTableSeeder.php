<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            [
                'id' => '90907625-7972-4d65-9f78-58ec23fb41b7',
                'sei' => '吉本',
                'mei' => '恒生',
                'sei_hira' => 'よしもと',
                'mei_hira' => 'こうき',
                'self_introduction' => 'ダイエット指導が1番の得意分野です。',
                'password' => bcrypt('testtest'),
            ],
        ]);
        DB::table('players')->insert([
            [
                'id' => '9090781e-8791-4317-b040-c43ad557f57b',
                'sei' => '上田',
                'mei' => '翔',
                'sei_hira' => 'うえだ',
                'mei_hira' => 'しょう',
                'self_introduction' => '初心者の方を対象にした運動不足解消や体力向上のためのメニュー作り運動指導',
                'password' => bcrypt('testtest'),
            ],
        ]);
    }
}
