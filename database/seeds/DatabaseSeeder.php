<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
                // PlayersTableSeeder::class,
                AdminsTableSeeder::class,
                UsersTableSeeder::class,
                StoresTableSeeder::class,
                CoursesTableSeeder::class,
                NotesTableSeeder::class,
            ]
        );
    }
}
