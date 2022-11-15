<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Database\Factories\AuthorBookFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  AuthorBook::factory()->times(10)->create();

    //   $authors = Author::all();
    //   $books = Book::all();


    //   return [
    //       'author_id' => $authors->random()->id,
    //       'book_id' => $books->random()->id
    //   ];


    }
}
