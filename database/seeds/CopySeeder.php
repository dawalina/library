<?php

use Illuminate\Database\Seeder;

class CopySeeder extends Seeder
{

    private $books;

    public function __construct()
    {
        $this->books = \DB::table('books')->get();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->books as $book) {
            DB::table('copies')->insert([
                'book_id' => $book->id,
                'status' => rand(0, 1),
                'created_at' => now()
            ]);
            DB::table('copies')->insert([
                'book_id' => $book->id,
                'status' => rand(0, 1),
                'created_at' => now()
            ]);
            DB::table('copies')->insert([
                'book_id' => $book->id,
                'status' => rand(0, 1),
                'created_at' => now()
            ]);
        }
    }
}
