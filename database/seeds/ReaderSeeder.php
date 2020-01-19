<?php

use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    private $authors;

    public function __construct()
    {
        $this->authors = \DB::table('authors')->get();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->authors as $author) {
            DB::table('readers')->insert([
                'first_name' => $author->first_name,
                'last_name'  => $author->last_name,
                'email'      => $this->getEmail($author),
                'created_at' => now()
            ]);
        }
    }

    private function getEmail($author) {
        return $author->id . '_' . $this->normalizeString($author->last_name) . '_'
            . $this->normalizeString($author->first_name) . '@gmail.com';
    }

    private function normalizeString($str) {
        $lowerCase = strtolower($str);
        return preg_replace('/[^a-z]/', '', $lowerCase);
    }
}
