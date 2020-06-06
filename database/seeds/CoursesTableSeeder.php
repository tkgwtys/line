<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();
        DB::table('courses')->insert([
            [
                'id' => 1,
                'name' => 'スタンダードプラン',
                'price' => '8500',
                'total_price' => '34000',
                'month_count' => '4',
                'course_time' => '60',
                'description' => '今後のダイエットに向けて最適な食生活プランをご提案',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 2,
                'name' => 'ライトプラン',
                'price' => '10000',
                'total_price' => '22000',
                'month_count' => '2',
                'course_time' => '60',
                'description' => '忙しい方やゆっくり運動を始めていきたいという方におすすめの月額お安くなる月２回プランです。',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 3,
                'name' => 'オリジナルプラン',
                'price' => '7500',
                'total_price' => '45000',
                'month_count' => '6',
                'course_time' => '60',
                'description' => '「とにかくしっかり結果を出したい」という方にオススメ！月６回〜のお申込みで１回あたりのお値段がお安くなるお得なプランです。',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 4,
                'name' => 'チケット制「有効期限４ヶ月」',
                'price' => '11000',
                'total_price' => '11000',
                'month_count' => '10',
                'course_time' => '60',
                'description' => NULL,
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
