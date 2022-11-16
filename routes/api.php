<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// every route within these curly brackets require authentication token
Route::middleware('auth:sanctum')->group(function (){
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/auth/user',[AuthController::class, 'user']);

    // You need to be logged in for all book functionality except get all and get by id
    Route::apiResource('/books', BookController::class)->except((['index', 'show']));
});

// This one line creates all routes for the BookController
// if you are not providing all actions the you don't need all the routes
// so you can specfiy the routes individually
//Route::apiResource('/books', BookController::class);

// Books - Define the get all and get by ID routes outside the authentication group
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);


// this line create all routes for PublisherController.
// These routes can all be accessed without an authentication token.
// How would you alter this so you need authentication for publisher routes that alter the database?
Route::apiResource('/publishers', PublisherController::class);

// This will define the route for Author, the implementation is not yet completed, so it's commented out.
// Route::resource('/authors', AuthorController::class)->only(['index', 'show']);
