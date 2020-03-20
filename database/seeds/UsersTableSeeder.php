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
                'name'=>'user1',
                'email'=>'user1@test.com',
                'password'=> bcrypt('testtest'),
            ],
        ]);
    }
}
