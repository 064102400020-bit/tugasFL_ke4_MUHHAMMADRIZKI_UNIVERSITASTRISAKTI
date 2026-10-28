# Tugas Framework Laravel 4 — Read & Create Data (REST API)

Tugas mata kuliah Pemrograman Framework Laravel ke-4: Implementasi REST API untuk operasi **Read All Data (GET)** dan **Create Data (POST)** menggunakan **Eloquent ORM**, **Data Validation**, **$fillable (Mass Assignment Protection)**, serta pengelolaan **HTTP Status Codes** yang standar (200, 201, 422, 500).

---

## 📋 Informasi Mahasiswa & Repositori
- **Nama Repositori**: `tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI`
- **GitHub URL**: [https://github.com/064102400020-bit/tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI.git](https://github.com/064102400020-bit/tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI.git)
- **Tautan Controller di GitHub**:
  - [GenreController.php](https://github.com/064102400020-bit/tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI/blob/main/app/Http/Controllers/GenreController.php)
  - [AuthorController.php](https://github.com/064102400020-bit/tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI/blob/main/app/Http/Controllers/AuthorController.php)

---

## 🛠️ Teknologi & Fitur
- **Framework**: Laravel 12.x
- **Database**: MySQL (`db_tugas_pertemuan4`)
- **Fitur Utama**:
  1. **Eloquent ORM**: Seluruh interaksi database dilakukan melalui Model `Genre` dan `Author` tanpa query SQL manual.
  2. **Mass Assignment Protection**: Menggunakan properti `protected $fillable` pada setiap Model.
  3. **Data Validation**: Validasi request otomatis mengembalikan response JSON (status 422) tanpa redirect HTML.
  4. **Postman Collection**: File `postman_collection.json` siap pakai di root direktori.

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
| `country` | VARCHAR(100) | Opsional (Nullable) |
| `created_at` | TIMESTAMP | Waktu pembuatan |
| `updated_at` | TIMESTAMP | Waktu pembaharuan terakhir |

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/064102400020-bit/tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI.git
   cd tugasFL_ke4_MUHHAMMADRIZKI_UNIVERSITASTRISAKTI
   ```

2. **Install Dependensi PHP**:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**:
   Salin `.env.example` ke `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Pastikan Database MySQL dibuat**:
   Pastikan XAMPP / MySQL service aktif, buat database:
   ```sql
   CREATE DATABASE IF NOT EXISTS db_tugas_pertemuan4;
   ```
   Atur konfigurasi pada `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_tugas_pertemuan4
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi & Seeder**:
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Development Server**:
   ```bash
   php artisan serve
   ```
   Server aktif di `http://127.0.0.1:8000`.

---

## 📮 Panduan Testing API dengan Postman

Tersedia file `postman_collection.json` di root project. Anda dapat langsung mengimport file tersebut ke Postman (**Import -> File -> Upload postman_collection.json**).

Semua request **wajib menyertakan Header**:
```http
Accept: application/json
Content-Type: application/json
```

---

### A. Endpoint GENRE

#### 1. READ ALL GENRES
- **Method**: `GET`
- **URL**: `http://127.0.0.1:8000/api/genres`
- **Headers**:
  - `Accept: application/json`
- **Body**: *None*
- **HTTP Status**: `200 OK`
- **Contoh Response**:
  ```json
  {
    "success": true,
    "message": "Data genre berhasil diambil",
    "data": [
      {
        "id": 1,
        "name": "Fiksi",
        "description": "Karya sastra berupa cerita rekaan atau khayalan, tidak berdasarkan fakta nyata.",
        "created_at": "2026-10-28T06:27:56.000000Z",
        "updated_at": "2026-10-28T06:27:56.000000Z"
      },
      {
        "id": 2,
        "name": "Non-Fiksi",
        "description": "Karya tulis berdasarkan fakta, data, dan kejadian nyata.",
        "created_at": "2026-10-28T06:27:56.000000Z",
        "updated_at": "2026-10-28T06:27:56.000000Z"
      }
    ]
  }
  ```

---

#### 2. CREATE GENRE — Skenario Sukses
- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/genres`
- **Headers**:
  - `Accept: application/json`
  - `Content-Type: application/json`
- **Body (raw JSON)**:
  ```json
  {
    "name": "Misteri",
    "description": "Kisah penuh teka-teki, investigasi detektif, dan pengungkapan rahasia."
  }
  ```
- **HTTP Status**: `201 Created`
- **Contoh Response**:
  ```json
  {
    "success": true,
    "message": "Data genre berhasil dibuat",
    "data": {
      "name": "Misteri",
      "description": "Kisah penuh teka-teki, investigasi detektif, dan pengungkapan rahasia.",
      "updated_at": "2026-10-28T06:30:00.000000Z",
      "created_at": "2026-10-28T06:30:00.000000Z",
      "id": 6
    }
  }
  ```

---

#### 3. CREATE GENRE — Skenario Gagal (Nama Kosong)
- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/genres`
- **Headers**:
  - `Accept: application/json`
  - `Content-Type: application/json`
- **Body (raw JSON)**:
  ```json
  {
    "name": "",
    "description": "Deskripsi tanpa nama genre"
  }
  ```
- **HTTP Status**: `422 Unprocessable Entity`
- **Contoh Response**:
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

#### 4. CREATE GENRE — Skenario Gagal (Nama Duplikat / Unique)
- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/genres`
- **Headers**:
  - `Accept: application/json`
  - `Content-Type: application/json`
- **Body (raw JSON)**:
  ```json
  {
    "name": "Fiksi",
    "description": "Mencoba membuat nama genre yang sudah ada."
  }
  ```
- **HTTP Status**: `422 Unprocessable Entity`
- **Contoh Response**:
  ```json
  {
    "success": false,
    "message": "Validasi gagal. Periksa kembali data yang dikirim.",
    "data": {
      "name": [
        "The name has already been taken."
      ]
    }
  }
  ```

---

### B. Endpoint AUTHOR

#### 1. READ ALL AUTHORS
- **Method**: `GET`
- **URL**: `http://127.0.0.1:8000/api/authors`
- **Headers**:
  - `Accept: application/json`
- **Body**: *None*
- **HTTP Status**: `200 OK`
- **Contoh Response**:
  ```json
  {
    "success": true,
    "message": "Data author berhasil diambil",
    "data": [
      {
        "id": 1,
        "name": "Pramoedya Ananta Toer",
        "bio": "Sastrawan besar Indonesia, penulis Tetralogi Buru yang terkenal di seluruh dunia.",
        "country": "Indonesia",
        "created_at": "2026-10-28T06:27:56.000000Z",
        "updated_at": "2026-10-28T06:27:56.000000Z"
      },
      {
        "id": 2,
        "name": "Andrea Hirata",
        "bio": "Penulis novel Laskar Pelangi yang menjadi salah satu novel terlaris Indonesia.",
        "country": "Indonesia",
        "created_at": "2026-10-28T06:27:56.000000Z",
        "updated_at": "2026-10-28T06:27:56.000000Z"
      }
    ]
  }
  ```

---

#### 2. CREATE AUTHOR — Skenario Sukses
- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/authors`
- **Headers**:
  - `Accept: application/json`
  - `Content-Type: application/json`
- **Body (raw JSON)**:
  ```json
  {
    "name": "Ahmad Fuadi",
    "bio": "Penulis novel trilogi Negeri 5 Menara, mantan wartawan TEMPO dan VOA.",
    "country": "Indonesia"
  }
  ```
- **HTTP Status**: `201 Created`
- **Contoh Response**:
  ```json
  {
    "success": true,
    "message": "Data author berhasil dibuat",
    "data": {
      "name": "Ahmad Fuadi",
      "bio": "Penulis novel trilogi Negeri 5 Menara, mantan wartawan TEMPO dan VOA.",
      "country": "Indonesia",
      "updated_at": "2026-10-28T06:30:00.000000Z",
      "created_at": "2026-10-28T06:30:00.000000Z",
      "id": 6
    }
  }
  ```

---

#### 3. CREATE AUTHOR — Skenario Gagal (Nama Kosong)
- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/authors`
- **Headers**:
  - `Accept: application/json`
  - `Content-Type: application/json`
- **Body (raw JSON)**:
  ```json
  {
    "name": "",
    "bio": "Penulis tanpa nama",
    "country": "Indonesia"
  }
  ```
- **HTTP Status**: `422 Unprocessable Entity`
- **Contoh Response**:
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

## 🎯 Ringkasan Standar HTTP Status Code
| Kode Status | Keterangan | Penggunaan dalam Proyek Ini |
| :---: | :--- | :--- |
| **200 OK** | Permintaan berhasil diproses | `GET /api/genres`, `GET /api/authors` |
| **201 Created** | Data baru berhasil dibuat | `POST /api/genres`, `POST /api/authors` |
| **404 Not Found** | Rute atau resource tidak ditemukan | Akses URL di luar rute API yang didefinisikan |
| **422 Unprocessable** | Validasi input gagal | `POST` saat field `name` kosong atau duplikat |
| **500 Server Error** | Terjadi kesalahan internal server | Kesalahan database connection / unhandled crash |
