<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| API Routes — Tugas Framework Laravel ke-5
| Materi: Implementasi Show, Update, Destroy Genre & Author (API Resource)
|--------------------------------------------------------------------------
|
| Semua route di bawah ini memiliki prefix /api secara otomatis
| sebagaimana dikonfigurasi pada bootstrap/app.php.
|
*/

// ─── API RESOURCE ROUTES ───────────────────────────────────────────────────────
// Route::apiResource() secara otomatis mendaftarkan 5 endpoint RESTful:
// 1. GET        /api/genres          -> genres.index   (GenreController@index)
// 2. POST       /api/genres          -> genres.store   (GenreController@store)
// 3. GET        /api/genres/{genre}  -> genres.show    (GenreController@show)
// 4. PUT/PATCH  /api/genres/{genre}  -> genres.update  (GenreController@update)
// 5. DELETE     /api/genres/{genre}  -> genres.destroy (GenreController@destroy)

Route::apiResource('genres', GenreController::class);

// 1. GET        /api/authors         -> authors.index   (AuthorController@index)
// 2. POST       /api/authors         -> authors.store   (AuthorController@store)
// 3. GET        /api/authors/{author}-> authors.show    (AuthorController@show)
// 4. PUT/PATCH  /api/authors/{author}-> authors.update  (AuthorController@update)
// 5. DELETE     /api/authors/{author}-> authors.destroy (AuthorController@destroy)

Route::apiResource('authors', AuthorController::class);
