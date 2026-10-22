<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\JenisOlahraga;
use App\Models\Lapangan;
use App\Models\SlotWaktu;
use App\Models\Reservasi;
use App\Models\Produk;
use App\Models\DetailReservasi;

class SportSpaceSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DATA USER DAN ADMIN
        |--------------------------------------------------------------------------
        */

        $admin = User::create([
            'nama' => 'Admin SportSpace',
            'email' => 'admin@sportspace.test',
            'password' => Hash::make('password'),
            'no_telepon' => '081234567890',
            'role' => 'admin',
        ]);

        $user = User::create([
            'nama' => 'Andi Pratama',
            'email' => 'andi@sportspace.test',
            'password' => Hash::make('password'),
            'no_telepon' => '081298765432',
            'role' => 'user',
        ]);


        /*
        |--------------------------------------------------------------------------
        | JENIS OLAHRAGA
        |--------------------------------------------------------------------------
        */

        $padel = JenisOlahraga::create([
            'nama' => 'Padel',
        ]);

        $miniSoccer = JenisOlahraga::create([
            'nama' => 'Mini Soccer',
        ]);

        $badminton = JenisOlahraga::create([
            'nama' => 'Badminton',
        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA LAPANGAN
        |--------------------------------------------------------------------------
        */

        $padelCourt1 = Lapangan::create([
            'jenis_olahraga_id' => $padel->id,
            'nama' => 'Padel Court 1',
            'harga_per_jam' => 150000,
            'status' => 'aktif',
        ]);

        $padelCourt2 = Lapangan::create([
            'jenis_olahraga_id' => $padel->id,
            'nama' => 'Padel Court 2',
            'harga_per_jam' => 150000,
            'status' => 'aktif',
        ]);

        $miniSoccerField1 = Lapangan::create([
            'jenis_olahraga_id' => $miniSoccer->id,
            'nama' => 'Mini Soccer Field 1',
            'harga_per_jam' => 350000,
            'status' => 'aktif',
        ]);

        $badmintonCourt1 = Lapangan::create([
            'jenis_olahraga_id' => $badminton->id,
            'nama' => 'Badminton Court 1',
            'harga_per_jam' => 75000,
            'status' => 'aktif',
        ]);

        $badmintonCourt2 = Lapangan::create([
            'jenis_olahraga_id' => $badminton->id,
            'nama' => 'Badminton Court 2',
            'harga_per_jam' => 75000,
            'status' => 'aktif',
        ]);

        $badmintonCourt3 = Lapangan::create([
            'jenis_olahraga_id' => $badminton->id,
            'nama' => 'Badminton Court 3',
            'harga_per_jam' => 75000,
            'status' => 'aktif',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SLOT WAKTU
        |--------------------------------------------------------------------------
        |
        | Setiap lapangan memiliki slot waktu satu jam.
        |
        */

        $jamMulai = [
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
        ];

        $semuaLapangan = [
            $padelCourt1,
            $padelCourt2,
            $miniSoccerField1,
            $badmintonCourt1,
            $badmintonCourt2,
            $badmintonCourt3,
        ];

        foreach ($semuaLapangan as $lapangan) {

            foreach ($jamMulai as $jam) {

                $jamSelesai = date(
                    'H:i',
                    strtotime($jam . ' +1 hour')
                );

                SlotWaktu::create([
                    'lapangan_id' => $lapangan->id,
                    'jam_mulai' => $jam,
                    'jam_selesai' => $jamSelesai,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUK MAKANAN
        |--------------------------------------------------------------------------
        */

        $sandwich = Produk::create([
            'nama' => 'Sandwich',
            'kategori' => 'Makanan',
            'deskripsi' => 'Sandwich sederhana untuk menemani aktivitas olahraga.',
            'harga' => 25000,
            'gambar' => null,
            'status' => 'aktif',
        ]);

        $kentang = Produk::create([
            'nama' => 'Kentang Goreng',
            'kategori' => 'Makanan',
            'deskripsi' => 'Kentang goreng renyah.',
            'harga' => 20000,
            'gambar' => null,
            'status' => 'aktif',
        ]);

        $roti = Produk::create([
            'nama' => 'Roti Bakar',
            'kategori' => 'Makanan',
            'deskripsi' => 'Roti bakar dengan pilihan rasa.',
            'harga' => 18000,
            'gambar' => null,
            'status' => 'aktif',
        ]);


        /*
        |--------------------------------------------------------------------------
        | PRODUK MINUMAN
        |--------------------------------------------------------------------------
        */

        $airMineral = Produk::create([
            'nama' => 'Air Mineral',
            'kategori' => 'Minuman',
            'deskripsi' => 'Air mineral kemasan.',
            'harga' => 8000,
            'gambar' => null,
            'status' => 'aktif',
        ]);

        $tehBotol = Produk::create([
            'nama' => 'Teh Botol',
            'kategori' => 'Minuman',
            'deskripsi' => 'Minuman teh dalam kemasan.',
            'harga' => 10000,
            'gambar' => null,
            'status' => 'aktif',
        ]);

        $isotonik = Produk::create([
            'nama' => 'Minuman Isotonik',
            'kategori' => 'Minuman',
            'deskripsi' => 'Minuman untuk membantu mengganti cairan tubuh.',
            'harga' => 12000,
            'gambar' => null,
            'status' => 'aktif',
        ]);


        /*
        |--------------------------------------------------------------------------
        | HELPER MENGAMBIL SLOT
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk mencari slot berdasarkan lapangan dan jam.
        |
        */

        $ambilSlot = function ($lapanganId, $jam) {
            return SlotWaktu::where('lapangan_id', $lapanganId)
                ->where('jam_mulai', $jam)
                ->first();
        };


        /*
        |--------------------------------------------------------------------------
        | RESERVASI CONTOH 1
        |--------------------------------------------------------------------------
        | Status: Menunggu
        */

        $slot1 = $ambilSlot(
            $miniSoccerField1->id,
            '15:00'
        );

        $reservasi1 = Reservasi::create([
            'kode_reservasi' => 'RSV-SPT001',
            'user_id' => $user->id,

            'nama' => 'Fadhil Raihan',
            'email' => 'fadhil@sportspace.test',
            'telepon' => '081234567891',
            'catatan' => 'Reservasi untuk latihan.',
            
            'lapangan_id' => $miniSoccerField1->id,
            'slot_id' => $slot1->id,
            'tanggal' => '2026-09-02',

            'total_harga' => $miniSoccerField1->harga_per_jam,

            'status' => 'Menunggu',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESERVASI CONTOH 2
        |--------------------------------------------------------------------------
        | Status: Disetujui
        */

        $slot2 = $ambilSlot(
            $miniSoccerField1->id,
            '16:00'
        );

        $reservasi2 = Reservasi::create([
            'kode_reservasi' => 'RSV-SPT002',
            'user_id' => $user->id,

            'nama' => 'Andi Pratama',
            'email' => 'andi@sportspace.test',
            'telepon' => '081298765432',
            'catatan' => 'Latihan bersama teman.',

            'lapangan_id' => $miniSoccerField1->id,
            'slot_id' => $slot2->id,
            'tanggal' => '2026-09-03',

            'total_harga' => $miniSoccerField1->harga_per_jam,

            'status' => 'Disetujui',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESERVASI CONTOH 3
        |--------------------------------------------------------------------------
        | Status: Disetujui
        */

        $slot3 = $ambilSlot(
            $padelCourt1->id,
            '19:00'
        );

        $reservasi3 = Reservasi::create([
            'kode_reservasi' => 'RSV-SPT003',
            'user_id' => $user->id,

            'nama' => 'Reyhan Fadil',
            'email' => 'reyhan@sportspace.test',
            'telepon' => '081298765433',
            'catatan' => null,

            'lapangan_id' => $padelCourt1->id,
            'slot_id' => $slot3->id,
            'tanggal' => '2026-09-04',

            'total_harga' => $padelCourt1->harga_per_jam,

            'status' => 'Disetujui',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESERVASI CONTOH 4
        |--------------------------------------------------------------------------
        | Status: Ditolak
        */

        $slot4 = $ambilSlot(
            $padelCourt2->id,
            '18:00'
        );

        $reservasi4 = Reservasi::create([
            'kode_reservasi' => 'RSV-SPT004',
            'user_id' => $user->id,

            'nama' => 'Budi Santoso',
            'email' => 'budi@sportspace.test',
            'telepon' => '081298765434',
            'catatan' => 'Mohon dikonfirmasi.',

            'lapangan_id' => $padelCourt2->id,
            'slot_id' => $slot4->id,
            'tanggal' => '2026-09-01',

            'total_harga' => $padelCourt2->harga_per_jam,

            'status' => 'Ditolak',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESERVASI CONTOH 5
        |--------------------------------------------------------------------------
        | Status: Ditolak
        */

        $slot5 = $ambilSlot(
            $badmintonCourt1->id,
            '14:00'
        );

        $reservasi5 = Reservasi::create([
            'kode_reservasi' => 'RSV-SPT005',
            'user_id' => $user->id,

            'nama' => 'Citra Lestari',
            'email' => 'citra@sportspace.test',
            'telepon' => '081298765435',
            'catatan' => null,

            'lapangan_id' => $badmintonCourt1->id,
            'slot_id' => $slot5->id,
            'tanggal' => '2026-09-02',

            'total_harga' => $badmintonCourt1->harga_per_jam,

            'status' => 'Ditolak',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESERVASI CONTOH 6
        |--------------------------------------------------------------------------
        | Status: Draft
        |--------------------------------------------------------------------------
        |
        | Data Draft digunakan sebagai simulasi reservasi yang masih berada
        | pada tahap pemilihan makanan/minuman dan belum masuk ke proses admin.
        |
        */

        $slot6 = $ambilSlot(
            $badmintonCourt2->id,
            '16:00'
        );

        $reservasi6 = Reservasi::create([
            'kode_reservasi' => 'RSV-SPT006',
            'user_id' => $user->id,

            'nama' => 'Dimas Pratama',
            'email' => 'dimas@sportspace.test',
            'telepon' => '081298765436',
            'catatan' => 'Masih memilih tambahan.',

            'lapangan_id' => $badmintonCourt2->id,
            'slot_id' => $slot6->id,
            'tanggal' => '2026-09-05',

            'total_harga' => $badmintonCourt2->harga_per_jam,

            'status' => 'Draft',
        ]);


        /*
        |--------------------------------------------------------------------------
        | DETAIL PRODUK RESERVASI
        |--------------------------------------------------------------------------
        |
        | Beberapa reservasi diberikan contoh makanan/minuman agar halaman
        | bukti reservasi dan PDF dapat langsung diuji.
        |
        */

        DetailReservasi::create([
            'reservasi_id' => $reservasi2->id,
            'produk_id' => $airMineral->id,
            'jumlah' => 2,
            'harga' => $airMineral->harga,
            'subtotal' => $airMineral->harga * 2,
        ]);

        DetailReservasi::create([
            'reservasi_id' => $reservasi2->id,
            'produk_id' => $sandwich->id,
            'jumlah' => 1,
            'harga' => $sandwich->harga,
            'subtotal' => $sandwich->harga,
        ]);

        $tambahanReservasi2 =
            ($airMineral->harga * 2) +
            $sandwich->harga;

        $reservasi2->update([
            'total_harga' =>
                $miniSoccerField1->harga_per_jam +
                $tambahanReservasi2,
        ]);


        DetailReservasi::create([
            'reservasi_id' => $reservasi3->id,
            'produk_id' => $tehBotol->id,
            'jumlah' => 2,
            'harga' => $tehBotol->harga,
            'subtotal' => $tehBotol->harga * 2,
        ]);

        DetailReservasi::create([
            'reservasi_id' => $reservasi3->id,
            'produk_id' => $isotonik->id,
            'jumlah' => 1,
            'harga' => $isotonik->harga,
            'subtotal' => $isotonik->harga,
        ]);

        $tambahanReservasi3 =
            ($tehBotol->harga * 2) +
            $isotonik->harga;

        $reservasi3->update([
            'total_harga' =>
                $padelCourt1->harga_per_jam +
                $tambahanReservasi3,
        ]);
    }
}