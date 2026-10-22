<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {

            $table->id();

            $table->string('kode_reservasi')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('lapangan_id')
                ->constrained('lapangan')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('slot_id')
                ->constrained('slot_waktu')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->date('tanggal');

            $table->decimal('total_harga', 12, 2);

            $table->enum('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])->default('Menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};