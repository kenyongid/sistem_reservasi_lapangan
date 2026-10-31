
````md
# SportSpace

## Sistem Informasi Reservasi Lapangan Olahraga Berbasis Web

SportSpace adalah sistem informasi reservasi lapangan olahraga berbasis web yang dikembangkan untuk membantu proses pemesanan dan pengelolaan lapangan olahraga secara terkomputerisasi.

Sistem ini menyediakan layanan reservasi untuk tiga jenis olahraga, yaitu:

- Padel
- Mini Soccer
- Badminton

SportSpace memiliki dua sisi utama, yaitu halaman pengguna untuk melakukan reservasi dan halaman administrator untuk mengelola data lapangan, produk tambahan, reservasi, serta laporan.

---

# Daftar Isi

- [Tentang SportSpace](#tentang-sportspace)
- [Tujuan](#tujuan)
- [Fitur Sistem](#fitur-sistem)
- [Alur Reservasi](#alur-reservasi)
- [Status Reservasi](#status-reservasi)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Framework dan Library](#framework-dan-library)
- [Arsitektur MVC](#arsitektur-mvc)
- [Struktur Database](#struktur-database)
- [Relasi Database](#relasi-database)
- [Struktur Project](#struktur-project)
- [Routing](#routing)
- [Sistem Reservasi](#sistem-reservasi)
- [Pencegahan Double Booking](#pencegahan-double-booking)
- [Perhitungan Harga](#perhitungan-harga)
- [Authentication dan Middleware](#authentication-dan-middleware)
- [Dashboard Administrator](#dashboard-administrator)
- [Laporan Mingguan](#laporan-mingguan)
- [Export Data](#export-data)
- [Bukti Reservasi PDF](#bukti-reservasi-pdf)
- [Validasi Data](#validasi-data)
- [Debugging](#debugging)
- [Instalasi](#instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Penggunaan Sistem](#penggunaan-sistem)
- [Dokumentasi Teknologi](#dokumentasi-teknologi)
- [Pengembang](#pengembang)

---

# Tentang SportSpace

SportSpace dikembangkan sebagai sistem informasi berbasis web yang menangani proses reservasi lapangan olahraga mulai dari pemilihan lapangan, pemilihan tanggal dan waktu, pengisian data pemesan, pemilihan makanan atau minuman tambahan, hingga menghasilkan bukti reservasi.

Pada sisi administrator, sistem menyediakan halaman dashboard dan halaman pengelolaan data untuk membantu administrator mengelola operasional reservasi.

Sistem menggunakan framework Laravel dengan pendekatan Model-View-Controller (MVC) serta MySQL sebagai basis data.

---

# Tujuan

Tujuan pengembangan SportSpace adalah:

1. Memudahkan pengguna dalam mencari dan memilih lapangan olahraga.
2. Memudahkan pengguna melakukan reservasi berdasarkan tanggal dan slot waktu.
3. Mengurangi risiko terjadinya pemesanan pada slot yang sama.
4. Menyediakan pilihan makanan dan minuman tambahan dalam proses reservasi.
5. Mengotomatisasi perhitungan total pembayaran.
6. Menyediakan bukti reservasi dalam format PDF.
7. Membantu administrator mengelola data lapangan.
8. Membantu administrator mengelola produk makanan dan minuman.
9. Membantu administrator melakukan validasi reservasi.
10. Menyediakan informasi statistik reservasi melalui dashboard.
11. Menyediakan laporan reservasi mingguan.
12. Memudahkan administrator melakukan export data laporan.

---

# Fitur Sistem

## 1. Landing Page

Halaman awal SportSpace berfungsi sebagai halaman informasi utama bagi pengguna.

Informasi yang tersedia meliputi:

- Informasi SportSpace.
- Jenis olahraga.
- Informasi lapangan.
- Navigasi menuju proses reservasi.

---

## 2. Daftar Lapangan

Pengguna dapat melihat daftar lapangan yang tersedia.

Data lapangan yang ditampilkan dapat meliputi:

- Nama lapangan.
- Jenis olahraga.
- Deskripsi.
- Harga per jam.
- Status lapangan.
- Gambar lapangan.

Lapangan yang berstatus aktif dapat digunakan untuk proses reservasi.

---

## 3. Detail Lapangan

Pengguna dapat melihat informasi lebih detail mengenai lapangan sebelum melakukan reservasi.

Setelah menentukan lapangan, pengguna dapat melanjutkan ke pemilihan tanggal dan slot waktu.

---

## 4. Pemilihan Tanggal dan Slot Waktu

Pengguna dapat memilih:

- Tanggal reservasi.
- Slot waktu.

Sistem akan melakukan pengecekan terhadap reservasi yang sudah tersimpan untuk mengetahui slot yang telah digunakan.

Slot yang sudah digunakan tidak dapat dipilih kembali.

---

## 5. Form Data Pemesan

Pengguna mengisi data sebelum reservasi dibuat.

Data yang digunakan:

- Nama.
- Email.
- Nomor telepon.
- Catatan.

Data tersebut disimpan bersama informasi lapangan, tanggal, dan slot waktu.

---

## 6. Makanan dan Minuman Tambahan

Setelah reservasi lapangan dibuat, pengguna dapat memilih produk tambahan.

Produk dibagi menjadi dua kategori:

- Makanan.
- Minuman.

Pengguna dapat menentukan jumlah produk yang ingin ditambahkan.

Sistem kemudian menghitung subtotal setiap produk dan menambahkannya ke total reservasi.

---

## 7. Bukti Reservasi

Setelah proses reservasi selesai, pengguna dapat melihat detail reservasi.

Informasi yang ditampilkan meliputi:

- Kode reservasi.
- Status reservasi.
- Informasi lapangan.
- Jenis olahraga.
- Tanggal reservasi.
- Jam reservasi.
- Data pemesan.
- Makanan dan minuman tambahan.
- Total pembayaran.
- Catatan.

---

## 8. Pencarian Reservasi

Pengguna dapat mencari reservasi berdasarkan kode reservasi.

Kode reservasi digunakan untuk mengakses kembali informasi reservasi yang telah dibuat.

Format kode reservasi menggunakan pola:

```text
RSV-XXXXXXXX
````

---

## 9. Download Bukti Reservasi

Detail reservasi dapat diunduh dalam format PDF.

PDF berisi informasi reservasi dengan tampilan yang disesuaikan dengan halaman detail reservasi SportSpace.

---

# Alur Reservasi

Proses reservasi pada SportSpace:

```text
Pilih Lapangan
       |
       v
Pilih Tanggal
       |
       v
Pilih Slot Waktu
       |
       v
Isi Data Pemesan
       |
       v
Konfirmasi Reservasi
       |
       v
Reservasi Dibuat
       |
       v
Pilih Makanan / Minuman
       |
       v
Hitung Total Pembayaran
       |
       v
Reservasi Selesai
       |
       v
Status Menunggu
       |
       v
Validasi Administrator
       |
       +----------------+
       |                |
       v                v
  Disetujui          Ditolak
       |
       v
Bukti Reservasi
```

---

# Status Reservasi

SportSpace menggunakan empat status reservasi:

| Status      | Keterangan                                                                       |
| ----------- | -------------------------------------------------------------------------------- |
| `Draft`     | Reservasi sementara ketika pengguna masih berada dalam proses pemesanan tambahan |
| `Menunggu`  | Reservasi telah selesai dibuat dan menunggu validasi administrator               |
| `Disetujui` | Reservasi telah disetujui oleh administrator                                     |
| `Ditolak`   | Reservasi ditolak oleh administrator                                             |

Alur status:

```text
Draft
  |
  v
Menunggu
  |
  +----------+
  |          |
  v          v
Disetujui  Ditolak
```

Status `Draft` merupakan status sementara. Data dengan status tersebut tidak digunakan sebagai reservasi final pada statistik dan laporan administrator.

Namun, status `Draft` tetap diperhitungkan dalam pengecekan ketersediaan slot agar pengguna lain tidak dapat mengambil slot yang sedang digunakan dalam proses reservasi.

---

# Teknologi yang Digunakan

| Teknologi       | Fungsi                          |
| --------------- | ------------------------------- |
| PHP             | Bahasa pemrograman utama        |
| Laravel         | Framework pengembangan aplikasi |
| MySQL           | Sistem manajemen basis data     |
| Blade           | Template engine Laravel         |
| HTML            | Struktur halaman                |
| CSS             | Pengaturan tampilan             |
| JavaScript      | Interaksi pada sisi frontend    |
| Bootstrap 5     | Framework CSS                   |
| Bootstrap Icons | Library ikon                    |
| Laragon         | Local development environment   |

---

# Framework dan Library

## Laravel

Laravel digunakan sebagai framework utama dalam pengembangan SportSpace.

Laravel digunakan untuk:

* Routing.
* Controller.
* Model.
* Eloquent ORM.
* Validation.
* Authentication.
* Middleware.
* Session.
* Database interaction.
* View menggunakan Blade.

SportSpace menggunakan arsitektur MVC.

---

## Blade

Blade merupakan template engine Laravel yang digunakan untuk membuat halaman antarmuka.

Blade digunakan untuk:

* Menampilkan data dari controller.
* Perulangan data.
* Kondisi tampilan.
* Penggunaan layout.
* Menampilkan notifikasi.
* Menghasilkan halaman dinamis.

Contoh:

```blade
@foreach($lapangan as $item)
    <h3>{{ $item->nama }}</h3>
@endforeach
```

---

## Eloquent ORM

Eloquent merupakan ORM yang digunakan Laravel untuk berinteraksi dengan database.

Eloquent digunakan untuk:

* Mengambil data.
* Menambahkan data.
* Mengubah data.
* Menghapus data.
* Melakukan filtering.
* Melakukan agregasi.
* Mengatur relationship antar-model.

Contoh:

```php
$lapangan = Lapangan::where('status', 'aktif')->get();
```

---

## Bootstrap 5

Bootstrap digunakan untuk membantu pembuatan antarmuka yang responsif.

Komponen yang digunakan antara lain:

* Button.
* Card.
* Form.
* Table.
* Navbar.
* Badge.
* Grid.
* Modal.

---

## Bootstrap Icons

Bootstrap Icons digunakan untuk menampilkan ikon pada antarmuka sistem.

Contoh:

```html
<i class="bi bi-eye"></i>
<i class="bi bi-check-lg"></i>
<i class="bi bi-x-lg"></i>
<i class="bi bi-calendar-week"></i>
```

---

## ApexCharts

ApexCharts digunakan untuk menampilkan visualisasi data pada dashboard administrator.

Grafik digunakan untuk menampilkan jumlah reservasi berdasarkan status:

* Menunggu.
* Disetujui.
* Ditolak.

Data grafik diproses pada controller kemudian dikirim ke Blade dan ditampilkan menggunakan JavaScript.

---

## SweetAlert2

SweetAlert2 digunakan untuk menampilkan notifikasi dan dialog konfirmasi.

Contoh penggunaan:

* Notifikasi berhasil.
* Notifikasi gagal.
* Konfirmasi penghapusan.
* Konfirmasi persetujuan.
* Konfirmasi penolakan.

---

## Carbon

Carbon digunakan untuk mengelola data tanggal dan waktu.

Dalam SportSpace, Carbon digunakan untuk:

* Menentukan awal minggu.
* Menentukan akhir minggu.
* Mengolah laporan mingguan.
* Menentukan minggu sebelumnya.
* Menentukan minggu berikutnya.
* Melakukan perhitungan tanggal.

---

## Laravel DomPDF

Laravel DomPDF digunakan untuk menghasilkan bukti reservasi dalam format PDF.

Contoh penggunaan:

```php
$pdf = Pdf::loadView(
    'layout.booking.pdf',
    compact('reservasi')
);
```

File kemudian dapat diunduh oleh pengguna.

---

## Laravel Excel

Laravel Excel digunakan untuk membuat laporan dalam format Excel.

Data reservasi dari database diproses melalui class export kemudian dihasilkan menjadi file Excel.

---

# Arsitektur MVC

SportSpace menggunakan pola Model-View-Controller (MVC).

```text
              USER
                |
                v
              ROUTE
                |
                v
           CONTROLLER
           /         \
          v           v
       MODEL        VIEW
          |           |
          v           |
       DATABASE       |
          |           |
          +-----------+
                |
                v
              USER
```

---

## Model

Model bertanggung jawab terhadap data dan interaksi dengan database.

Model yang digunakan:

```text
User
JenisOlahraga
Lapangan
SlotWaktu
Reservasi
Produk
DetailReservasi
```

---

## View

View bertanggung jawab terhadap tampilan antarmuka.

SportSpace menggunakan Blade sebagai template engine.

View dikelompokkan berdasarkan kebutuhan sistem, seperti:

```text
resources/views/layout/
```

Bagian utama meliputi:

```text
admin/
booking/
```

---

## Controller

Controller menangani logika aplikasi dan menghubungkan Model dengan View.

Controller utama:

```text
LandingController
LapanganController
BookingController
AdminAuthController
```

Controller administrator:

```text
admin/
├── DashboardController
├── LapanganController
├── ProdukController
└── ReservasiController
```

---

# Struktur Database

SportSpace menggunakan MySQL sebagai database.

Tabel utama:

```text
users
jenis_olahraga
lapangan
slot_waktu
reservasi
produk
detail_reservasi
```

---

## Tabel Users

Digunakan untuk menyimpan data pengguna dan administrator.

Kolom utama:

```text
id
nama
email
no_telepon
password
role
created_at
updated_at
```

---

## Tabel Jenis Olahraga

Digunakan untuk menyimpan jenis olahraga.

Jenis olahraga yang digunakan:

```text
Padel
Mini Soccer
Badminton
```

---

## Tabel Lapangan

Digunakan untuk menyimpan data lapangan.

Data utamanya meliputi:

```text
id
jenis_olahraga_id
nama
deskripsi
harga_per_jam
gambar
status
created_at
updated_at
```

---

## Tabel Slot Waktu

Digunakan untuk menyimpan slot waktu yang tersedia pada lapangan.

Kolom:

```text
id
lapangan_id
jam_mulai
jam_selesai
created_at
updated_at
```

---

## Tabel Reservasi

Digunakan untuk menyimpan data utama reservasi.

Kolom:

```text
id
kode_reservasi
user_id
nama
email
telepon
catatan
lapangan_id
slot_id
tanggal
total_harga
status
created_at
updated_at
```

---

## Tabel Produk

Digunakan untuk menyimpan data makanan dan minuman.

Kolom:

```text
id
nama
kategori
deskripsi
harga
gambar
status
created_at
updated_at
```

Kategori:

```text
Makanan
Minuman
```

---

## Tabel Detail Reservasi

Digunakan untuk menyimpan produk tambahan yang dipilih dalam suatu reservasi.

Kolom:

```text
id
reservasi_id
produk_id
jumlah
harga
subtotal
created_at
updated_at
```

---

# Relasi Database

Relasi utama pada database SportSpace:

```text
JenisOlahraga
      |
      | 1 : N
      v
Lapangan
      |
      | 1 : N
      v
SlotWaktu


User
  |
  | 1 : N
  v
Reservasi
  |
  +------------------+
  |                  |
  v                  v
Lapangan          SlotWaktu
  |
  |
  v
DetailReservasi
  |
  | N : 1
  v
Produk
```

Relationship Eloquent yang digunakan:

```text
JenisOlahraga
    hasMany Lapangan

Lapangan
    belongsTo JenisOlahraga
    hasMany SlotWaktu

Reservasi
    belongsTo User
    belongsTo Lapangan
    belongsTo SlotWaktu
    hasMany DetailReservasi

DetailReservasi
    belongsTo Reservasi
    belongsTo Produk

Produk
    hasMany DetailReservasi
```

---

# Struktur Project

Struktur utama project Laravel:

```text
SportSpace/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminAuthController.php
│   │       ├── BookingController.php
│   │       ├── LandingController.php
│   │       ├── LapanganController.php
│   │       │
│   │       └── admin/
│   │           ├── DashboardController.php
│   │           ├── LapanganController.php
│   │           ├── ProdukController.php
│   │           └── ReservasiController.php
│   │
│   └── Models/
│       ├── User.php
│       ├── JenisOlahraga.php
│       ├── Lapangan.php
│       ├── SlotWaktu.php
│       ├── Reservasi.php
│       ├── Produk.php
│       └── DetailReservasi.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── template/
│       ├── admin/
│       ├── css/
│       ├── js/
│       └── img/
│
├── resources/
│   └── views/
│       └── layout/
│           ├── admin/
│           └── booking/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── .env
├── artisan
├── composer.json
└── README.md
```

---

# Routing

Routing digunakan untuk menghubungkan URL dengan controller.

Contoh route halaman booking:

```php
Route::get('/booking/{lapangan}', [BookingController::class, 'create'])
    ->name('booking.create');

Route::post('/booking', [BookingController::class, 'store'])
    ->name('booking.store');
```

Route pencarian reservasi:

```php
Route::get('/booking/cari', [BookingController::class, 'cari'])
    ->name('booking.cari');
```

Route makanan dan minuman tambahan:

```php
Route::get('/booking/{id}/tambahan', [BookingController::class, 'tambahan'])
    ->name('booking.tambahan');

Route::post('/booking/{id}/tambahan', [BookingController::class, 'simpanTambahan'])
    ->name('booking.tambahan.simpan');
```

Route administrator menggunakan prefix:

```text
/admin
```

Contoh:

```text
/admin
/admin/lapangan
/admin/produk
/admin/reservasi
/admin/report/mingguan
```

---

# Sistem Reservasi

Proses reservasi ditangani oleh `BookingController`.

Fungsi utama yang digunakan:

```text
index()
create()
store()
tambahan()
simpanTambahan()
cari()
show()
downloadPdf()
slotTerpakai()
```

Fungsinya antara lain:

| Method             | Fungsi                                          |
| ------------------ | ----------------------------------------------- |
| `index()`          | Menampilkan daftar lapangan                     |
| `create()`         | Menampilkan form reservasi dan slot waktu       |
| `store()`          | Menyimpan reservasi awal                        |
| `tambahan()`       | Menampilkan pilihan makanan dan minuman         |
| `simpanTambahan()` | Menyimpan produk tambahan dan memperbarui total |
| `cari()`           | Mencari reservasi berdasarkan kode              |
| `show()`           | Menampilkan detail reservasi                    |
| `downloadPdf()`    | Menghasilkan bukti reservasi PDF                |
| `slotTerpakai()`   | Mengambil slot yang telah digunakan             |

---

# Pencegahan Double Booking

Sistem melakukan pengecekan sebelum reservasi dibuat.

Data yang diperiksa:

```text
Lapangan
Tanggal
Jam Mulai
Jam Selesai
Status Reservasi
```

Status yang dianggap menggunakan slot:

```php
['Draft', 'Menunggu', 'Disetujui']
```

Contoh pengecekan:

```php
$sudahDipesan = Reservasi::where(
    'lapangan_id',
    $validated['lapangan_id']
)
    ->whereDate('tanggal', $validated['tanggal'])
    ->whereIn('status', ['Draft', 'Menunggu', 'Disetujui'])
    ->whereHas('slotWaktu', function ($query) use ($slot) {
        $query->where('jam_mulai', $slot->jam_mulai)
            ->where('jam_selesai', $slot->jam_selesai);
    })
    ->exists();
```

Jika hasil pengecekan bernilai `true`, sistem akan menolak reservasi dan meminta pengguna memilih slot lain.

---

# Perhitungan Harga

Harga reservasi terdiri dari harga lapangan dan produk tambahan.

Rumus:

```text
Total Pembayaran
=
Harga Lapangan
+
Total Produk Tambahan
```

Sedangkan subtotal produk:

```text
Subtotal
=
Harga Produk × Jumlah
```

Contoh:

```text
Harga Lapangan        Rp150.000
Makanan                Rp25.000
Minuman                Rp10.000
--------------------------------
Total                  Rp185.000
```

Pada saat produk tambahan disimpan, total tambahan dijumlahkan dengan total harga lapangan.

---

# Authentication dan Middleware

Administrator memiliki sistem login khusus.

Route login:

```text
/admin/login
```

Setelah berhasil login, administrator diarahkan ke dashboard.

Halaman administrator menggunakan middleware `auth`.

Alur authentication:

```text
Admin
 |
 v
/admin/login
 |
 v
Validasi Login
 |
 v
Authentication
 |
 v
Middleware auth
 |
 v
Dashboard Admin
```

Logout dilakukan melalui route administrator.

---

# Dashboard Administrator

Dashboard administrator digunakan untuk memberikan ringkasan kondisi sistem.

Informasi yang ditampilkan:

```text
Total Lapangan
Reservasi Minggu Ini
Menunggu Persetujuan
Pendapatan Minggu Ini
```

Dashboard juga menampilkan:

* Statistik status reservasi.
* Grafik reservasi mingguan.
* Pendapatan makanan dan minuman.
* Produk terlaris.
* Reservasi terbaru.

---

# Grafik Reservasi

Grafik menggunakan ApexCharts.

Data yang ditampilkan berdasarkan hari dalam satu minggu:

```text
Senin
Selasa
Rabu
Kamis
Jumat
Sabtu
Minggu
```

Setiap hari dapat memiliki data:

```text
Menunggu
Disetujui
Ditolak
```

Data grafik berasal dari database dan diproses melalui controller.

Contoh struktur data:

```javascript
const labels = laporan.map(item => item.tanggal);

const menunggu = laporan.map(item => item.menunggu);

const disetujui = laporan.map(item => item.disetujui);

const ditolak = laporan.map(item => item.ditolak);
```

---

# Laporan Mingguan

SportSpace menyediakan halaman laporan mingguan administrator.

Laporan menggunakan periode:

```text
Awal Minggu
sampai
Akhir Minggu
```

Administrator dapat berpindah periode menggunakan:

```text
Minggu Sebelumnya
Minggu Ini
Minggu Berikutnya
```

Laporan dapat menampilkan:

* Jumlah reservasi.
* Jumlah disetujui.
* Jumlah menunggu.
* Jumlah ditolak.
* Pendapatan reservasi.
* Pendapatan makanan dan minuman.
* Produk terlaris.
* Data reservasi harian.

---

# Pendapatan

Pendapatan utama dihitung berdasarkan reservasi dengan status:

```text
Disetujui
```

Pendapatan reservasi menggunakan nilai:

```text
total_harga
```

Nilai `total_harga` sudah mencakup:

```text
Harga Lapangan
+
Makanan / Minuman Tambahan
```

Dengan demikian, pendapatan dari reservasi yang disetujui sudah mencakup produk tambahan yang terdapat pada reservasi tersebut.

---

# Pendapatan Makanan dan Minuman

SportSpace juga menyediakan informasi pendapatan khusus produk tambahan.

Data diperoleh dari tabel:

```text
detail_reservasi
```

Pendapatan produk dihitung berdasarkan:

```text
subtotal
```

dari detail reservasi yang memiliki reservasi dengan status:

```text
Disetujui
```

---

# Produk Terlaris

Sistem dapat menampilkan produk terlaris berdasarkan jumlah produk yang terjual.

Data dihitung dengan melakukan agregasi:

```text
SUM(jumlah)
```

dan dapat disertai dengan:

```text
SUM(subtotal)
```

Produk kemudian diurutkan berdasarkan jumlah penjualan.

---

# Export Data

SportSpace menyediakan export laporan dalam dua format:

```text
CSV
Excel
```

## CSV

CSV digunakan untuk menghasilkan data dalam format Comma-Separated Values.

Kolom laporan:

```text
No
Kode Reservasi
Pelanggan
Email
Nomor Telepon
Lapangan
Jenis Olahraga
Tanggal
Jam
Makanan / Minuman
Total Tambahan
Total Harga
Status
```

Data `Draft` tidak dimasukkan ke laporan final.

---

## Excel

Laravel Excel digunakan untuk menghasilkan laporan dalam format `.xlsx`.

Data yang diekspor memiliki struktur yang sama dengan laporan CSV.

Export dapat dilakukan berdasarkan minggu yang sedang dipilih pada halaman laporan.

---

# Bukti Reservasi PDF

Bukti reservasi dibuat menggunakan Laravel DomPDF.

Informasi yang terdapat dalam PDF:

```text
SPORTSPACE

Reservasi Berhasil

Kode Reservasi
Status

Informasi Lapangan
Jenis Olahraga
Tanggal
Jam

Makanan & Minuman Tambahan

Total Pembayaran

Data Pemesan
Nama
Email
Nomor Telepon

Catatan

Informasi Reservasi
```

PDF tidak menampilkan tombol atau elemen interaktif dari halaman web.

---

# Validasi Data

Validasi dilakukan menggunakan fitur validation Laravel.

Contoh validasi reservasi:

```php
$validated = $request->validate([
    'lapangan_id' => 'required|exists:lapangan,id',
    'slot_id' => 'required|exists:slot_waktu,id',
    'tanggal' => 'required|date|after_or_equal:today',
    'nama' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'telepon' => 'required|string|max:20',
    'catatan' => 'nullable|string|max:500',
]);
```

Validasi bertujuan memastikan data yang diterima sistem sesuai dengan aturan yang telah ditentukan.

---

# CRUD

Administrator memiliki fungsi CRUD pada beberapa data.

## CRUD Lapangan

```text
Create
Read
Update
Delete
```

Digunakan untuk mengelola data lapangan.

## CRUD Produk

```text
Create
Read
Update
Delete
```

Digunakan untuk mengelola makanan dan minuman.

---

# File Upload

Produk dapat memiliki gambar.

Data gambar disimpan sebagai nama/path file pada database, sedangkan file gambar disimpan pada storage yang digunakan aplikasi.

File upload digunakan untuk mendukung tampilan produk makanan dan minuman pada halaman reservasi dan administrator.

---

# Notifikasi Administrator

Sistem menyediakan indikator notifikasi pada halaman administrator.

Notifikasi digunakan untuk menunjukkan jumlah reservasi yang masih memiliki status:

```text
Menunggu
```

Administrator dapat mengakses halaman reservasi untuk melakukan validasi.

---

# Debugging

Debugging dilakukan berdasarkan bagian sistem yang mengalami masalah.

## Backend

Pengecekan backend dilakukan terhadap:

* Route.
* Controller.
* Model.
* Validation.
* Query database.
* Eloquent relationship.
* Authentication.
* Middleware.

Laravel memberikan informasi error ketika terjadi exception sehingga bagian kode yang bermasalah dapat ditelusuri.

## Frontend

Browser Developer Tools digunakan untuk memeriksa:

```text
Console
Network
Elements
```

### Console

Digunakan untuk memeriksa error JavaScript.

### Network

Digunakan untuk memeriksa request dan response antara browser dengan server.

### Elements

Digunakan untuk memeriksa struktur HTML dan CSS.

## Database

MySQL/phpMyAdmin digunakan untuk memeriksa:

* Struktur tabel.
* Data.
* Foreign key.
* Relationship.
* Hasil query.
* Data hasil proses reservasi.

---

# Pengelolaan Cache dan Artisan

Laravel Artisan digunakan untuk membantu pengelolaan aplikasi.

Contoh perintah:

```bash
php artisan serve
```

Untuk melihat daftar route:

```bash
php artisan route:list
```

Untuk membersihkan cache aplikasi:

```bash
php artisan optimize:clear
```

Perintah Artisan digunakan untuk membantu proses pengembangan, pengecekan, dan pengelolaan aplikasi Laravel.

---

# Instalasi

## Persyaratan

Pastikan perangkat telah memiliki:

* PHP
* Composer
* MySQL
* Laragon atau web server yang kompatibel
* Node.js dan NPM apabila diperlukan oleh asset frontend

---

## 1. Menyiapkan Project

Letakkan project SportSpace pada direktori web server.

Contoh menggunakan Laragon:

```text
C:\laragon\www\SportSpace
```

---

## 2. Install Dependency Laravel

Jalankan:

```bash
composer install
```

---

## 3. Install Dependency Frontend

Jika project menggunakan dependency NPM:

```bash
npm install
```

---

## 4. Membuat File Environment

Salin:

```text
.env.example
```

menjadi:

```text
.env
```

Kemudian sesuaikan konfigurasi aplikasi.

---

## 5. Konfigurasi Database

Buat database dengan nama:

```text
sportspace
```

Kemudian konfigurasi file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sportspace
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL pada komputer.

---

## 6. Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

---

## 7. Menjalankan Migration

Jalankan:

```bash
php artisan migrate
```

Jika ingin menjalankan migration beserta seeder:

```bash
php artisan migrate --seed
```

Seeder digunakan untuk memasukkan data awal sistem.

---

## 8. Menjalankan Storage Link

Jika sistem menggunakan file storage publik:

```bash
php artisan storage:link
```

---

## 9. Menjalankan Aplikasi

Jalankan:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

Jika menggunakan Laragon, aplikasi juga dapat dijalankan melalui virtual host Laragon sesuai konfigurasi project.

---

# Konfigurasi Database

Struktur database dibuat menggunakan Laravel Migration.

Migration digunakan untuk mendefinisikan:

* Tabel.
* Kolom.
* Tipe data.
* Foreign key.
* Default value.
* Relasi antar tabel.

Contoh pembuatan tabel produk:

```php
Schema::create('produk', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->enum('kategori', ['Makanan', 'Minuman']);
    $table->text('deskripsi')->nullable();
    $table->decimal('harga', 12, 2);
    $table->string('gambar')->nullable();
    $table->enum('status', ['aktif', 'nonaktif'])
        ->default('aktif');
    $table->timestamps();
});
```

---

# Penggunaan Sistem

## Pengguna

Langkah penggunaan:

1. Membuka halaman SportSpace.
2. Memilih lapangan.
3. Memilih tanggal.
4. Memilih slot waktu.
5. Mengisi data pemesan.
6. Melakukan konfirmasi reservasi.
7. Memilih makanan atau minuman tambahan jika diperlukan.
8. Menyelesaikan pemesanan.
9. Sistem menghasilkan kode reservasi.
10. Pengguna dapat melihat detail reservasi.
11. Pengguna dapat mengunduh bukti reservasi PDF.

---

## Administrator

Langkah penggunaan:

1. Membuka halaman login administrator.
2. Melakukan login.
3. Membuka dashboard.
4. Mengelola data lapangan.
5. Mengelola data makanan dan minuman.
6. Membuka daftar reservasi.
7. Melihat detail reservasi.
8. Menyetujui atau menolak reservasi.
9. Melihat laporan mingguan.
10. Melakukan export laporan jika diperlukan.

---

# Keamanan dan Integritas Data

SportSpace menerapkan beberapa mekanisme untuk menjaga integritas data:

* Validasi input menggunakan Laravel Validation.
* Authentication pada halaman administrator.
* Middleware `auth` untuk membatasi akses halaman admin.
* Penggunaan Eloquent ORM untuk interaksi database.
* Foreign key pada tabel yang memiliki hubungan.
* Pengecekan slot sebelum reservasi dibuat.
* Pembatasan status reservasi dalam proses bisnis.
* CSRF protection pada form Laravel.

---

# Konsep Business Logic

Beberapa aturan bisnis yang diterapkan pada SportSpace:

### 1. Lapangan harus aktif

Lapangan yang berstatus nonaktif tidak dapat digunakan untuk reservasi.

### 2. Tanggal reservasi tidak boleh melewati aturan tanggal sistem

Tanggal reservasi divalidasi menggunakan:

```text
after_or_equal:today
```

### 3. Slot yang digunakan tidak dapat dipesan kembali

Sistem mengecek reservasi berdasarkan:

```text
Lapangan
Tanggal
Jam
```

### 4. Reservasi baru memiliki status Draft

Reservasi pertama kali dibuat sebagai:

```text
Draft
```

Kemudian setelah proses tambahan selesai:

```text
Menunggu
```

### 5. Administrator melakukan validasi

Reservasi dengan status `Menunggu` dapat:

```text
Disetujui
```

atau

```text
Ditolak
```

### 6. Pendapatan dihitung dari reservasi yang disetujui

Reservasi dengan status `Disetujui` digunakan dalam perhitungan pendapatan.

---

# Dokumentasi Teknologi

Dokumentasi resmi teknologi yang digunakan dalam pengembangan SportSpace:

* Laravel: [https://laravel.com/docs](https://laravel.com/docs)
* Bootstrap: [https://getbootstrap.com/docs/](https://getbootstrap.com/docs/)
* Bootstrap Icons: [https://icons.getbootstrap.com/](https://icons.getbootstrap.com/)
* ApexCharts: [https://apexcharts.com/docs/](https://apexcharts.com/docs/)
* SweetAlert2: [https://sweetalert2.github.io/](https://sweetalert2.github.io/)
* Carbon: [https://carbon.nesbot.com/docs/](https://carbon.nesbot.com/docs/)
* Laravel Excel: [https://docs.laravel-excel.com/](https://docs.laravel-excel.com/)
* Laravel DomPDF: [https://github.com/barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)

---

# Ringkasan Teknologi

```text
Frontend
├── HTML
├── CSS
├── JavaScript
├── Blade
├── Bootstrap 5
├── Bootstrap Icons
├── ApexCharts
└── SweetAlert2

Backend
├── PHP
└── Laravel

Database
└── MySQL

Library
├── Carbon
├── Laravel DomPDF
└── Laravel Excel

Development Environment
└── Laragon
```

---

# Ringkasan Arsitektur

```text
                         SPORTSPACE
                              |
             +----------------+----------------+
             |                                 |
             v                                 v
       USER INTERFACE                    ADMIN INTERFACE
             |                                 |
             v                                 v
          BLADE                            BLADE
             |                                 |
             +----------------+----------------+
                              |
                              v
                         LARAVEL MVC
                              |
                 +------------+------------+
                 |                         |
                 v                         v
             CONTROLLER                  MODEL
                 |                         |
                 |                         v
                 |                      ELOQUENT
                 |                         |
                 +------------+------------+
                              |
                              v
                            MYSQL
```

---

# Kesimpulan

SportSpace merupakan sistem informasi reservasi lapangan olahraga berbasis web yang menangani proses reservasi mulai dari pemilihan lapangan, tanggal, dan slot waktu hingga proses validasi administrator.

Sistem juga menyediakan pengelolaan makanan dan minuman tambahan, perhitungan total harga, bukti reservasi PDF, dashboard statistik, laporan mingguan, serta export data dalam format CSV dan Excel.

Pengembangan sistem menggunakan Laravel dengan arsitektur MVC, MySQL sebagai database, Blade sebagai template engine, serta beberapa library pendukung untuk visualisasi data, notifikasi, pengolahan tanggal, pembuatan PDF, dan export Excel.

---

# Pengembang

**SportSpace**

Sistem Informasi Reservasi Lapangan Olahraga Berbasis Web

Teknologi utama:

```text
Laravel
PHP
MySQL
Blade
Bootstrap
JavaScript
```

```

Untuk README repository, versi di atas sudah mencakup **deskripsi → tujuan → fitur → alur bisnis → MVC → database → library/plugin → debugging → instalasi → penggunaan → dokumentasi**.

