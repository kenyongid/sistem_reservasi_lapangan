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
        Schema::create('slot_waktu', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lapangan_id')
                ->constrained('lapangan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->timestamps();

            $table->unique([
                'lapangan_id',
                'jam_mulai',
                'jam_selesai'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_waktu');
    }
};