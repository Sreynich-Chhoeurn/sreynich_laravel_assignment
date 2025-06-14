<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route Book
Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name("/allBooks");
    Route::get('/book/{id}', [BookController::class, 'show']);
    Route::post('/create', [BookController::class, 'createBook']);
    Route::put('/edit/{id}', [BookController::class, 'edit']);
    Route::delete('/delete/{id}', [BookController::class, 'delete']);
});

//Route Author
Route::prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name("/allAuthors");
    Route::get('/{id}', [AuthorController::class, 'show']);
    Route::post('/create', [AuthorController::class, 'createAuthor']);
    Route::put('/edit/{id}', [AuthorController::class, 'edit']);
    Route::delete('/delete/{id}', [AuthorController::class, 'delete']);
});

//Route User
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name("/allUsers");
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/create', [UserController::class, 'createUsers']);
    Route::put('/edit/{id}', [UserController::class, 'edit']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
