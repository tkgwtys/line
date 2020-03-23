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
        DB::table('Users')->insert([
            [
                'id' => (string)Str::orderedUuid(),
                'name'=>'chiba',
                'email'=>'bushi.chiba@abihc.com',
                'password'=> bcrypt('testtest'),
            ],
        ]);
    }
}
