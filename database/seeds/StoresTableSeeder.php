<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();
        DB::table('stores')->insert([
            [
                'id' => 1,
                'name' => '経堂店',
                'address' => '東京都世田谷区軽堂2-7-14 スズランスタジオ101',
                'tel' => '03-6413-9139',
                'url' => 'http://ramius-pt.com/',
                'business_hours' => '営業時間 7:00 〜 23:00（不定休）',
                'color_code' => '0',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 2,
                'name' => '千歳船橋',
                'address' => '東京都世田谷区船橋1-11-3 2階',
                'tel' => '03-6413-1540',
                'url' => 'http://ramius-pt.com/',
                'business_hours' => '営業時間 7:00 〜 23:00（不定休）',
                'color_code' => '0',
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
