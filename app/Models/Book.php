<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'category', 'author', 'likes', 'book_image', 'publisher_id'];
    //protected $guarded = [];


    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
