<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Kegiatan Sekolah',
                'deskripsi' => 'Dokumentasi berbagai kegiatan dan acara sekolah',
                'icon' => '🎓'
            ],
            [
                'nama' => 'Prestasi',
                'deskripsi' => 'Foto-foto prestasi siswa dan sekolah',
                'icon' => '🏆'
            ],
            [
                'nama' => 'Fasilitas',
                'deskripsi' => 'Galeri fasilitas dan infrastruktur sekolah',
                'icon' => '🏫'
            ],
            [
                'nama' => 'Ekstrakurikuler',
                'deskripsi' => 'Kegiatan ekstrakurikuler siswa',
                'icon' => '⚽'
            ],
            [
                'nama' => 'Wisuda & Kelulusan',
                'deskripsi' => 'Momen kelulusan dan wisuda',
                'icon' => '🎉'
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
