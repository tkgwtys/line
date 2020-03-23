<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Admins')->insert([
            [
                'id' => (string)Str::orderedUuid(),
                'name' => 'chiba',
                'email' => 'bushi.chiba@abihc.com',
                'password' => bcrypt('testtest'),
            ],
        ]);
    }
}
