<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('fotos', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->after('id')->constrained('kategoris')->onDelete('set null');
            $table->text('deskripsi')->nullable()->after('judul');
            $table->string('alt_text')->nullable()->after('path'); // untuk SEO
            $table->boolean('is_featured')->default(false)->after('alt_text'); // foto unggulan
        });
    }

    public function down(): void
    {
        Schema::table('fotos', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn(['kategori_id', 'deskripsi', 'alt_text', 'is_featured']);
        });
    }
};
