<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah enum tipe untuk menambahkan 'jurusan'
        DB::statement("ALTER TABLE informasis MODIFY COLUMN tipe ENUM('visi', 'misi', 'sejarah', 'jurusan', 'umum') DEFAULT 'umum'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan enum tipe ke nilai sebelumnya
        DB::statement("ALTER TABLE informasis MODIFY COLUMN tipe ENUM('visi', 'misi', 'sejarah', 'umum') DEFAULT 'umum'");
    }
};
