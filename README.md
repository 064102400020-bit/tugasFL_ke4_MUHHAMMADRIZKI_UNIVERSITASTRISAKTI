# Tugas Framework Laravel 5 — Implementasi Show, Update, Destroy Genre & Author menggunakan API Resource

Tugas mata kuliah Pemrograman Framework Laravel ke-5: Implementasi RESTful API untuk operasi **Show (GET by ID)**, **Update (PUT/PATCH by ID)**, dan **Destroy (DELETE by ID)** pada tabel **Genre** dan **Author** menggunakan **Route::apiResource()**, **Eloquent ORM**, **Custom JSON 404 Error Handling**, serta **Data Validation** (HTTP Status Codes: 200, 201, 404, 422).

---

## 📋 Informasi Mahasiswa & Repositori
- **Mahasiswa**: MUHAMMAD RIZKI (NIM: 064102400020)
- **Instansi**: Universitas Trisakti
- **Nama Repositori**: `TUGAS_FRAMEWORKLARAVEL-KE-5`
- **GitHub URL**: [https://github.com/064102400020-bit/TUGAS_FRAMEWORKLARAVEL-KE-5.git](https://github.com/064102400020-bit/TUGAS_FRAMEWORKLARAVEL-KE-5.git)
- **Tautan Controller di GitHub**:
  - [GenreController.php](https://github.com/064102400020-bit/TUGAS_FRAMEWORKLARAVEL-KE-5/blob/main/app/Http/Controllers/GenreController.php)
  - [AuthorController.php](https://github.com/064102400020-bit/TUGAS_FRAMEWORKLARAVEL-KE-5/blob/main/app/Http/Controllers/AuthorController.php)
- **Lokasi File Controller Lokal**:
  - `app/Http/Controllers/GenreController.php`
  - `app/Http/Controllers/AuthorController.php`
- **Lokasi File Route API**:
  - `routes/api.php`

---

## 🛠️ Fitur Utama & Ketentuan Pengerjaan
1. **API Resource Routing (`Route::apiResource`)**: Menggantikan deklarasi route manual dengan registrasi otomatis RESTful endpoint untuk Resource `genres` dan `authors`.
2. **Eloquent ORM**: Seluruh operasi pencarian (`find`), pembaruan (`update`), dan penghapusan (`delete`) dilakukan melalui Model Eloquent `Genre` dan `Author`.
3. **Penanganan Data Tidak Ditemukan (404)**: Jika data ID tidak ditemukan pada operasi Show, Update, maupun Destroy, API mengembalikan respons JSON terstruktur dengan HTTP status `404 Not Found`.
4. **Validasi Input (`$request->validate()`)**: Memvalidasi data yang dikirim client saat Update (misalnya `name` unik kecuali record itu sendiri, validasi tipe data) dengan status `422 Unprocessable Content`.
5. **Format Respons JSON Konsisten**: Format seragam dengan atribut `success`, `message`, dan `data` (jika mengembalikan objek).

---

## 🗄️ Struktur Database

### 1. Tabel `genres`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment |
| `name` | VARCHAR(255) | Wajib (Required), Unik (Unique) |
| `description`| TEXT | Opsional (Nullable) |
| `created_at` | TIMESTAMP | Waktu pembuatan |
| `updated_at` | TIMESTAMP | Waktu pembaharuan terakhir |

### 2. Tabel `authors`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment |
| `name` | VARCHAR(255) | Wajib (Required) |
| `bio` | TEXT | Opsional (Nullable) |
| `country` | VARCHAR(100) | Opsional (Nullable, Maks 100 Karakter) |
| `created_at` | TIMESTAMP | Waktu pembuatan |
| `updated_at` | TIMESTAMP | Waktu pembaharuan terakhir |

---

## 🛣️ Konfigurasi Route API (`routes/api.php`)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

Route::apiResource('genres', GenreController::class);
Route::apiResource('authors', AuthorController::class);
```

Daftar endpoint yang terdaftar (`php artisan route:list --path=api`):
| Method | URI | Action | Controller Method |
| :--- | :--- | :--- | :--- |
| `GET\|HEAD` | `/api/genres` | `genres.index` | `GenreController@index` |
| `POST` | `/api/genres` | `genres.store` | `GenreController@store` |
| `GET\|HEAD` | `/api/genres/{genre}` | `genres.show` | `GenreController@show` |
| `PUT\|PATCH` | `/api/genres/{genre}` | `genres.update` | `GenreController@update` |
| `DELETE` | `/api/genres/{genre}` | `genres.destroy` | `GenreController@destroy` |
| `GET\|HEAD` | `/api/authors` | `authors.index` | `AuthorController@index` |
| `POST` | `/api/authors` | `authors.store` | `AuthorController@store` |
| `GET\|HEAD` | `/api/authors/{author}` | `authors.show` | `AuthorController@show` |
| `PUT\|PATCH` | `/api/authors/{author}` | `authors.update` | `AuthorController@update` |
| `DELETE` | `/api/authors/{author}` | `authors.destroy` | `AuthorController@destroy` |

---

## 📦 Format Respons JSON

### 1. Show Data Ditemukan (HTTP 200 OK)
```json
{
    "success": true,
    "message": "Data Genre berhasil ditemukan",
    "data": {
        "id": 1,
        "name": "Fiksi",
        "description": "Karya sastra berupa cerita rekaan atau khayalan.",
        "created_at": "2026-10-28T06:27:59.000000Z",
        "updated_at": "2026-10-28T06:27:59.000000Z"
    }
}
```

### 2. Data Tidak Ditemukan (HTTP 404 Not Found)
```json
{
    "success": false,
    "message": "Data Genre tidak ditemukan"
}
```

### 3. Update Data Berhasil (HTTP 200 OK)
```json
{
    "success": true,
    "message": "Data Genre berhasil diperbarui",
    "data": {
        "id": 1,
        "name": "Fiksi Modern",
        "description": "Deskripsi diperbarui.",
        "created_at": "2026-10-28T06:27:59.000000Z",
        "updated_at": "2026-10-31T05:49:02.000000Z"
    }
}
```

### 4. Delete Data Berhasil (HTTP 200 OK)
```json
{
    "success": true,
    "message": "Data Genre berhasil dihapus"
}
```

### 5. Validasi Gagal (HTTP 422 Unprocessable Content)
```json
{
    "success": false,
    "message": "Validasi gagal. Periksa kembali data yang dikirim.",
    "data": {
        "name": [
            "The name field is required."
        ]
    }
}
```

---

## 🧪 Pengujian Menggunakan Postman
Koleksi lengkap Postman telah disediakan pada file [`postman_collection.json`](postman_collection.json).
Dapat langsung diimpor ke aplikasi Postman.

### Skenario Pengujian yang Disediakan:
1. **Show Genre & Author** (ID tersedia -> 200 OK, ID tidak tersedia -> 404 Not Found)
2. **Update Genre & Author via PUT & PATCH** (Data valid -> 200 OK, Data kosong/duplikat -> 422, ID tidak tersedia -> 404)
3. **Delete Genre & Author** (ID tersedia -> 200 OK, ID tidak tersedia -> 404 Not Found)

---

## ⚡ Menjalankan Automated Tests

Seluruh skenario telah diuji secara otomatis menggunakan PHPUnit Feature Tests:
```bash
php artisan test
```
Hasil:
- `Tests\Feature\GenreApiTest`: 10 passed
- `Tests\Feature\AuthorApiTest`: 10 passed
- `Total`: 22 passed (74 assertions)
