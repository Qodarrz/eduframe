<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'penulis',
        'kategori',
        'lokasi_terakhir',
        'lokasi',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Accessor: URL gambar
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/uploads/' . $this->gambar) : null;
    }

    // Scope: Published only
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope: Latest
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
