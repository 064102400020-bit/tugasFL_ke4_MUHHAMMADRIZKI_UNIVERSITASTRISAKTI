<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| API Routes — Tugas Framework Laravel ke-4
| Materi: Read All Data & Create Data (GET & POST)
|--------------------------------------------------------------------------
|
| Semua route di sini memiliki prefix /api secara otomatis
| (dikonfigurasi di bootstrap/app.php).
|
*/

// ─── GENRE ROUTES ─────────────────────────────────────────────────────────────

// GET /api/genres   → Ambil semua data genre (HTTP 200)
// POST /api/genres  → Buat genre baru (HTTP 201 | 422 jika validasi gagal)
Route::apiResource('genres', GenreController::class)->only(['index', 'store']);

// ─── AUTHOR ROUTES ────────────────────────────────────────────────────────────

// GET /api/authors   → Ambil semua data author (HTTP 200)
// POST /api/authors  → Buat author baru (HTTP 201 | 422 jika validasi gagal)
Route::apiResource('authors', AuthorController::class)->only(['index', 'store']);
