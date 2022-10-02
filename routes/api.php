<?php

use App\Http\Controllers\BookController;
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

// This one line creates all routes for the BookController
// if you are not providing all actions the you don't need all the routes
// so you can specfiy the routes individually
Route::apiResource('/books', BookController::class);

Route::resource('/authors', AuthorController::class)->only(['index', 'show']);
