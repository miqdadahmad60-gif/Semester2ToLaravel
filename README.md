# Smart School Kupang — Laravel

Port Laravel ini memindahkan fitur utama aplikasi CodeIgniter 3 pada ZIP sumber: landing page, autentikasi dan registrasi tiga peran, dashboard per peran, pengelolaan dan unduh materi, pembuatan/edit/hapus/kerjakan kuis, penyimpanan jawaban dan nilai, pemantauan nilai orang tua, pengajuan/edit/hapus fasilitas, pemrosesan status oleh guru, serta endpoint JSON login dan profil sesi.

## Database lokal

Aplikasi menggunakan **SQLite lokal** sehingga tidak memerlukan server MySQL/XAMPP untuk database. File database yang sudah berisi skema dan data demo ada di `database/database.sqlite`. Migrasi Laravel tersedia di `database/migrations` dan seeder data demo ada di `database/seeders/DatabaseSeeder.php`. Dump MySQL asli tetap disertakan di `database/legacy` sebagai referensi bila ingin pindah ke MySQL.

Akun demo:

- Siswa: `siswa@smartschool.test` / `siswa123`
- Guru: `guru@smartschool.test` / `guru123`
- Orang tua: `ortu@smartschool.test` / `ortu123`

## Menjalankan di Windows / XAMPP

Buka PowerShell pada folder proyek ini:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan serve
```

File SQLite dan data demo sudah disiapkan, jadi jangan jalankan seeder lagi pada database yang sudah berisi data. Untuk membangun database baru dari migrasi dan data contoh, buat file SQLite kosong lalu jalankan:

```powershell
New-Item -ItemType File -Force database/database.sqlite
php artisan migrate --seed
```

Untuk lampiran yang diunggah, Laravel menyimpannya pada `storage/app/public/materials`. Jika aplikasi juga perlu melayani URL publik untuk berkas, jalankan `php artisan storage:link`.

## Endpoint dan fitur

- Halaman: `/`, `/login`, `/register`, `/dashboard`, `/academic`, `/quizzes`, `/grades`, `/facilities`
- API sesi: `POST /api/login`, `GET /api/me`
- Materi: upload, edit, hapus, download; hanya guru pemilik materi yang dapat mengubahnya.
- Kuis: guru dapat buat/edit/hapus dan melihat hasil; siswa dapat mengerjakan satu kali; hasil tersimpan dan tampil di nilai siswa/orang tua.
- Fasilitas: siswa dapat mengajukan, mengedit atau membatalkan permintaan yang masih menunggu; guru dapat mengubah status dan menghapus permintaan.

## Perubahan dari CodeIgniter ke Laravel

- `application/config/routes.php` dipindahkan ke `routes/web.php`; kontrol alur dipusatkan di `app/Http/Controllers/SchoolController.php`.
- `School_model` dan query builder CI diganti query builder Laravel melalui `DB`.
- Helper CI, loader, dan sesi CI diganti route/controller Laravel, middleware `school.auth`, session Laravel, validasi request, redirect, respons JSON, dan Blade.
- Upload berkas pindah dari folder `uploads/materials` ke disk `public` Laravel.
- Skema yang sebelumnya disediakan dalam SQL MySQL dikonversi menjadi migrasi Laravel yang dapat dijalankan di SQLite; database lokal berisi tabel dan data demo yang sepadan.
- Tampilan sumber dipindahkan ke Blade dan aset CSS/JS/SVG dipertahankan. Beberapa detail visual diringkas, tetapi alur fitur utama dipertahankan.

Lihat [database/legacy/smartschool_kupang_database.sql](database/legacy/smartschool_kupang_database.sql) untuk dump MySQL sumber. File dump tersebut berisi perintah pembuatan ulang database MySQL; untuk penggunaan lokal bawaan, gunakan SQLite yang sudah disiapkan.
