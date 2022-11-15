<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->belongstoMany(Book::class)->withTimestamps();
        //return $this->belongstoMany(Book::class, 'author_book', 'book_id', 'author_id');
    }
}
