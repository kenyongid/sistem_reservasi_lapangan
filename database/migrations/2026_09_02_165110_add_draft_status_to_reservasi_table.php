<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE reservasi
            MODIFY status ENUM(
                'Draft',
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ) NOT NULL DEFAULT 'Menunggu'
        ");
    }

    public function down(): void
    {
        DB::table('reservasi')->where('status', 'Draft')->update(['status' => 'Menunggu']);
        DB::statement("
            ALTER TABLE reservasi
            MODIFY status ENUM(
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ) NOT NULL DEFAULT 'Menunggu'
        ");
    }
};
