<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * AuthorController — mengelola endpoint API untuk data penulis (author).
 * Mendukung: GET /api/authors (index) dan POST /api/authors (store).
 */
class AuthorController extends Controller
{
    /**
     * GET /api/authors
     * Mengambil semua data author dari database menggunakan Eloquent.
     *
     * @return JsonResponse HTTP 200 dengan daftar author
     */
    public function index(): JsonResponse
    {
        // Ambil semua data author menggunakan Eloquent ORM
        $authors = Author::all();

        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil diambil',
            'data'    => $authors,
        ], 200); // HTTP 200 OK
    }

    /**
     * POST /api/authors
     * Membuat author baru setelah validasi input.
     *
     * @param  Request $request  Data JSON dari body request
     * @return JsonResponse HTTP 201 dengan data author yang baru dibuat
     */
    public function store(Request $request): JsonResponse
    {
        // Validasi input yang dikirim client
        $validated = $request->validate([
            'name'    => 'required|string|max:255', // Wajib diisi
            'bio'     => 'nullable|string',         // Opsional
            'country' => 'nullable|string|max:100', // Opsional, maks 100 karakter
        ]);

        // Simpan author baru ke database menggunakan mass assignment
        $author = Author::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil dibuat',
            'data'    => $author,
        ], 201); // HTTP 201 Created
    }
}
