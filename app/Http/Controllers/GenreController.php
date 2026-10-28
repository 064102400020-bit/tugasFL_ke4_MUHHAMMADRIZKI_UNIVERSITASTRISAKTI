<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * GenreController — mengelola endpoint API untuk data genre.
 * Mendukung: GET /api/genres (index) dan POST /api/genres (store).
 */
class GenreController extends Controller
{
    /**
     * GET /api/genres
     * Mengambil semua data genre dari database menggunakan Eloquent.
     *
     * @return JsonResponse HTTP 200 dengan daftar genre
     */
    public function index(): JsonResponse
    {
        // Ambil semua data genre menggunakan Eloquent ORM
        $genres = Genre::all();

        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil diambil',
            'data'    => $genres,
        ], 200); // HTTP 200 OK
    }

    /**
     * POST /api/genres
     * Membuat genre baru setelah validasi input.
     *
     * @param  Request $request  Data JSON dari body request
     * @return JsonResponse HTTP 201 dengan data genre yang baru dibuat
     */
    public function store(Request $request): JsonResponse
    {
        // Validasi input yang dikirim client
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:genres,name', // Wajib, unik
            'description' => 'nullable|string',                            // Opsional
        ]);

        // Simpan genre baru ke database menggunakan mass assignment
        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil dibuat',
            'data'    => $genre,
        ], 201); // HTTP 201 Created
    }
}
