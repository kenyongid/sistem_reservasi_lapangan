<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
    {
        Schema::create('lapangan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jenis_olahraga_id')
                ->constrained('jenis_olahraga')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nama');
            $table->decimal('harga_per_jam', 12, 2);
            $table->enum('status', ['aktif', 'nonaktif'])
                ->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangan');
    }
};
