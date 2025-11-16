<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tipe',
        'urutan',
        'konten',
        'gambar',
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

    // Scope: By tipe
    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    // Scope: Ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }
}
