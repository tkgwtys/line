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
        DB::table('users')->insert([
            [
                'id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'name' => 'chiba',
                'sei' => '千葉',
                'mei' => '武士',
                'sei_hira' => 'ちば',
                'mei_hira' => 'たけし',
                'tel' => '08032015381',
                'email' => 'bushi.chiba@abihc.com',
                'password' => bcrypt('testtest'),
            ],
        ]);
        DB::table('users')->insert([
            [
                'id' => 'U84b55b6739d5f7ccce8f63de3307f857',
                'name' => 'NAR🐘',
                'sei' => '佐渡',
                'mei' => '永寛',
                'sei_hira' => 'さど',
                'mei_hira' => 'ながひろ',
                'tel' => '09086719258',
                'email' => 'nagaric@gmail.com',
                'password' => bcrypt('testtest'),
            ],
        ]);
        DB::table('users')->insert([
            [
                'id' => 'Uaedd4989ae9462602187d6d65fb150e2',
                'name' => 'Ryota',
                'sei' => '平野',
                'mei' => '亮太',
                'sei_hira' => 'ひらの',
                'mei_hira' => 'りょうた',
                'tel' => '09086719258',
                'email' => 'nobori-satuma@live.jp',
                'password' => bcrypt('testtest'),
            ],
        ]);
    }
}
