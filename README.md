# introduce

<h5>SIsarpas di build menggunakan framework laravel versi 10, jadi pastikan versi php anda sudah diatas versi >=7, (framework laravel adalah salah satu framwork dari bahasa pemrograman php) untuk membangun aplikasi berbasis web</h5>

<h5>
aktifkan require module php yang dibutukan untuk menjalankan framework tersebut, beberapa modul yang di harus di aktifkan ialah pdo_mysqli, mysqli, xml  dan mbstring 
</h5>

# Composer Run

```Bash
composer install
```

# Migrate Run

```Bash
php artisan migrate (wajib)
# migrate refresh ketika ada update/perubahan schema column table
php artisan migrate:refresh (optional)
# jika ingin rollback table nya jalan kan perintah di bawah ini
php artisan migrate:rollback (optional)

```

# Seeder Run

```Bash
php artisan db:seed
```

# Start Server

```Bash
php artisan serve
```
