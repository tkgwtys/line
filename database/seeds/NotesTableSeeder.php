<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();
        DB::table('notes')->insert([
            [
                'id' => '1',
                'admin_id' => '1',
                'user_id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'course_id' => '1',
                'note_contents' => '今日は腕のトレーニングを中心に実施',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => '2',
                'admin_id' => '2',
                'user_id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'course_id' => '1',
                'note_contents' => '今日は脚のトレーニングを中心に実施',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => '3',
                'admin_id' => '3',
                'user_id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'course_id' => '1',
                'note_contents' => '腕立て伏せ',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => '4',
                'admin_id' => '1',
                'user_id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'course_id' => '1',
                'note_contents' => '今日は肩のトレーニング',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => '5',
                'admin_id' => '3',
                'user_id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'course_id' => '1',
                'note_contents' => '今日はお腹のトレーニングを中心に実施',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => '6',
                'admin_id' => '2',
                'user_id' => 'U8299f8c45d021558f0d6e0355e5ccc6c',
                'course_id' => '1',
                'note_contents' => '今日は腕のトレーニングを中心に実施',
                'created_at' => $date,
                'updated_at' => $date,
            ],


        ]);
    }
}
