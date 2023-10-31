# infoglobal

# Panduan Instalasi

### Clone Repository

```
git clone https://github.com/saktialfansyahp/info-global.git
```

## Instalasi Projek Back End

## Masuk ke direktori be

```
cd be
```

## Instal dependensi

```
composer install
```

## Salin ENV

```
cp .env.example .env
```

## Generate kunci aplikasi

```
php artisan key:generate
```

## Generate Jwt Secret Key

```
php artisan jwt:secret
```

## Konfigurasi PostgreSQL database

DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

Sesuaikan host, port, nama database, username, dan passwordnya

## Migrasi Database

Lakukan perintah dibawah untuk melakukan migrasi database

```
php artisan migrate
```

## Jalankan Back End

```
php artisan serve
```

## Instalasi Projek Front End

### Masuk ke direktori fe

```
cd fe
```

### Instal dependensi

```
npm install
```

### Jalankan servernya dengan perintah

```
npm run serve
```

### Customize configuration

See [Configuration Reference](https://cli.vuejs.org/config/).

## Fitur

1. Login Register

2. CRUD Produk

   - Menambahkan produk baru ke dalam sistem.
   - Melihat daftar produk yang ada.
   - Mengedit informasi produk yang telah ada.
   - Menghapus produk yang tidak diperlukan.

3. Sorting dan Pencarian Produk

   Sorting dan pencarian produk bisa dilakukan berdasarkan nama produk, warna, kategori, sub kategori, maupun harga

4. Tambah dan Edit Kategori

5. Tambah dan Edit Subkategori

6. Tambah dan Edit Warna

7. Sorting dan Pencarian Kategori, Subkategori, dan Warna

   Sorting dan pencarian dapat dilakukan di setiap halaman masing masing

# Note

- Ketika hendak menambah produk, harap untuk menambahkan kategori, sub kategori, beserta warna terlebih dahulu karena untuk menambahkan produk membutuhkan data dari kategori, sub kategori, dan juga warna
- Untuk alur aplikasinya bisa mengikuti Flow Diagram
