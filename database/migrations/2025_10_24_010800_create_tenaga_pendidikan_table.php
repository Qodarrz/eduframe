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
        Schema::create('tenaga_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->enum('jenis', ['guru', 'staf']); // guru atau staf
            $table->string('jabatan'); // Guru Matematika, Kepala Sekolah, Staf TU, dll
            $table->string('pendidikan')->nullable(); // S1, S2, dll
            $table->string('foto')->nullable(); // path to photo
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('bidang_keahlian')->nullable(); // untuk guru
            $table->integer('urutan')->default(0); // untuk custom ordering
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_pendidikan');
    }
};
