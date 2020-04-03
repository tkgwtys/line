<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Runn the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'chiba',
                'email' => 'bushi.chiba@abihc.com',
                'password' => bcrypt('testtest'),
            ],
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'nar',
                'email' => 'nagaric@gmail.com',
                'password' => bcrypt('testtest'),
            ],
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'takagawa',
                'email' => 'tkgw@inmarks.jp',
                'password' => bcrypt('testtest'),
            ],
        ]);
    }
}
