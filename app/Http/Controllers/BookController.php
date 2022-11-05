<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
 * @OA\Get(
 *     path="/api/books",
 *     description="Displays all the books",
 *     tags={"Books"},
     *      @OA\Response(
        *          response=200,
        *          description="Successful operation, Returns a list of Books in JSON format"
        *       ),
        *      @OA\Response(
        *          response=401,
        *          description="Unauthenticated",
        *      ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
 * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new BookCollection(Book::all());
        return new BookCollection(Book::with('publisher')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/books",
     *      operationId="store",
     *      tags={"Books"},
     *      summary="Create a new Book",
     *      description="Stores the book in the DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "category", "description", "author", "likes"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample Title"),
     *            @OA\Property(property="category", type="string", format="string", example="Autobiography"),
     *            @OA\Property(property="description", type="string", format="string", example="A long description about this great book"),
     *            @OA\Property(property="author", type="string", format="string", example="Me"),
     *             @OA\Property(property="likes", type="integer", format="integer", example="1")
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\BookResource
     */
    public function store(Request $request)
    {
        $book_image = $request->file('book_image');
        $extension = $book_image->getClientOriginalExtension();
        // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;

        // store the file $book_image in /public/images, and name it $filename
        $path = $book_image->storeAs('public/images', $filename);

        $book = Book::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'author' => $request->author,
            'book_image' => $filename,
            'likes' => $request->likes,
            'publisher_id' => $request->publisher_id
        ]);


        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
    *     path="/api/books/{id}",
    *     description="Gets a book by ID",
    *     tags={"Books"},
    *          @OA\Parameter(
        *          name="id",
        *          description="Book id",
        *          required=true,
        *          in="path",
        *          @OA\Schema(
        *              type="integer")
     *          ),
        *      @OA\Response(
        *          response=200,
        *          description="Successful operation"
        *       ),
        *      @OA\Response(
        *          response=401,
        *          description="Unauthenticated",
        *      ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
 * )
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
        $book_image = $request->file('book_image');
        $extension = $book_image->getClientOriginalExtension();
        // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;

        // store the file $book_image in /public/images, and name it $filename
        $path = $book_image->storeAs('public/images', $filename);


        $book->update($request->only([
            'title', 'description', 'category', 'author', 'likes', 'publisher_id'
        ]));

        $book->update([
            'book_image' => $filename]
        );

        return new BookResource($book);
    }

    /**
     *
     *
     * @OA\Delete(
     *    path="/api/books/{id}",
     *    operationId="destroy",
     *    tags={"Books"},
     *    summary="Delete a Book",
     *    description="Delete Book",
     *    @OA\Parameter(name="id", in="path", description="Id of a Book", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=Response::HTTP_NO_CONTENT,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )

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
