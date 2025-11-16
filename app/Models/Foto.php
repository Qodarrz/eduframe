<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    
    protected $fillable = [
        'kategori_id',
        'judul',
        'deskripsi',
        'path',
        'alt_text',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Relasi: Foto milik satu Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Accessor: URL lengkap foto
    public function getUrlAttribute()
    {
        return asset('storage/uploads/' . $this->path);
    }

    // Scope: Foto unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope: Filter by kategori
    public function scopeByKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    // Relasi: Foto memiliki banyak likes
    public function likes()
    {
        return $this->hasMany(FotoLike::class);
    }

    // Relasi: Foto memiliki banyak comments
    public function comments()
    {
        return $this->hasMany(FotoComment::class);
    }

    // Accessor: Total likes
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    // Accessor: Total approved comments
    public function getCommentsCountAttribute()
    {
        return $this->comments()->where('is_approved', true)->count();
    }
}
