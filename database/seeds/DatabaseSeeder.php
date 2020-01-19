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
        $this->call(ReaderSeeder::class);
        $this->call(RentSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
