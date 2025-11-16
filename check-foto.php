<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$foto = App\Models\Foto::first();

if ($foto) {
    echo "=== INFO FOTO ===\n";
    echo "ID: " . $foto->id . "\n";
    echo "Judul: " . $foto->judul . "\n";
    echo "Path: " . $foto->path . "\n";
    echo "URL: " . $foto->url . "\n";
    echo "Kategori: " . ($foto->kategori ? $foto->kategori->nama : 'Tidak ada') . "\n";
    echo "\n=== CEK FILE ===\n";
    
    $storagePath = storage_path('app/public/uploads/' . $foto->path);
    echo "Storage Path: " . $storagePath . "\n";
    echo "File Exists: " . (file_exists($storagePath) ? 'YA' : 'TIDAK') . "\n";
    
    if (!file_exists($storagePath)) {
        echo "\n=== MENCARI FILE ===\n";
        // Cek di berbagai lokasi
        $locations = [
            storage_path('app/uploads/' . $foto->path),
            public_path('uploads/' . $foto->path),
            public_path('storage/uploads/' . $foto->path),
        ];
        
        foreach ($locations as $loc) {
            if (file_exists($loc)) {
                echo "DITEMUKAN DI: " . $loc . "\n";
            }
        }
    }
} else {
    echo "Belum ada foto di database\n";
}
