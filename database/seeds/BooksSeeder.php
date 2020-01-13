<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BooksSeeder extends Seeder
{

    private $books;

    public function __construct()
    {
        $this->books = json_decode(Storage::get('books.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->books as $book) {
            $bookModel = factory(\App\Models\Book::class)->create([
               'title' => $book->title,
                'category_id' => \App\Models\Category::firstOrCreate(['name' => $book->category])->id
            ]);

            $authorsIds = [];

            foreach ($book->authors as $author) {
                array_push($authorsIds, \App\Models\Author::firstOrCreate((array) $author)->id);
            }

            $bookModel->authors()->sync($authorsIds);
        }
    }
}
