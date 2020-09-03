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
                'password' => bcrypt('XwGHZH3w'),
            ],
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'nar',
                'email' => 'nagaric@gmail.com',
                'password' => bcrypt('196JwhPf'),
            ],
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'takagawa',
                'email' => 'tkgw@inmarks.jp',
                'password' => bcrypt('8Y0vufXx'),
            ],
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'hirano',
                'email' => 'nobori-satuma@live.jp',
                'password' => bcrypt('mefg72hP'),
            ],
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'ueda',
                'email' => 'sho.12no.1@gmail.com',
                'password' => bcrypt('ueda11030'),
            ],
        ]);
    }
}
