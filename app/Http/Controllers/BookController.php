<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $books = Book::all();
        // return new BookCollection($books);
       return new BookCollection(Book::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\BookResource
     */
    public function store(Request $request)
    {

        $book = Book::create($request->only([
            'title', 'description', 'category', 'author', 'likes'
        ]));

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\BookResource
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->only([
            'title', 'description', 'category', 'author', 'likes'
        ]));

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */

    // Note $book parameter passed in here.
    // If we had not enabled route model binding
    // when creating Controller and Model (using --Model)
    // there would only be a book Id passed in here, and we'd have to
    // check to see if the book exist.
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
