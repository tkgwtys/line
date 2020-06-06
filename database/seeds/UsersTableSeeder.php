<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();
        DB::table('users')->insert([
            [
                'id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'display_name' => 'chiba',
                'sei' => '千葉',
                'mei' => '武士',
                'sei_hira' => 'ちば',
                'mei_hira' => 'たけし',
                'picture_url' => NULL,
                'tel' => '080-3201-5381',
                'email' => 'bushi.chiba@abihc.com',
                'level' => 10,
                'password' => bcrypt('testtest'),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 'U84b55b6739d5f7ccce8f63de3307f857',
                'display_name' => 'NAR🐘',
                'sei' => '佐渡',
                'mei' => '永寛',
                'sei_hira' => 'さど',
                'mei_hira' => 'ながひろ',
                'picture_url' => NULL,
                'tel' => '090-8671-9258',
                'email' => 'nagaric@gmail.com',
                'level' => 10,
                'password' => bcrypt('testtest'),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 'Uaedd4989ae9462602187d6d65fb150e2',
                'display_name' => 'Ryota',
                'sei' => '平野',
                'mei' => '亮太',
                'sei_hira' => 'ひらの',
                'mei_hira' => 'りょうた',
                'picture_url' => NULL,
                'tel' => '090-8671-9258',
                'email' => 'nobori-satuma@live.jp',
                'level' => 10,
                'password' => bcrypt('testtest'),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 'U7fb49ca09c50b7d869f4c667eb3dcdc3',
                'display_name' => '上田翔',
                'sei' => '上田',
                'mei' => '翔',
                'sei_hira' => 'うえだ',
                'mei_hira' => 'しょう',
                'picture_url' => 'https://profile.line-scdn.net/0hIHA8wAcsFmd8QT3yIy5pMEAEGAoLbxAvBC4NVFlHSwcDJQIxF3dRVlwUHVVZcVU0QyJaVlAWHFVT',
                'tel' => NULL,
                'email' => NULL,
                'level' => 20,
                'password' => bcrypt('testtest'),
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
