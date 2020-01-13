<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'release_date',
        'category_id'
    ];

    public function authors() {
        return $this->belongsToMany(Author::class, 'books_authors');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
