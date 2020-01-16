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
        $this->call(BooksSeeder::class);
        $this->call(CopySeeder::class);
        $this->call(AdminSeeder::class);
    }
}
