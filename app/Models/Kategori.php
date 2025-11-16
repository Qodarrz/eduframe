<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'icon'
    ];

    // Auto-generate slug dari nama
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama);
            }
        });
        
        static::updating(function ($kategori) {
            if ($kategori->isDirty('nama') && empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama);
            }
        });
    }

    // Relasi: Kategori memiliki banyak Foto
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'kategori_id');
    }

    // Accessor: Hitung jumlah foto
    public function getFotoCountAttribute()
    {
        return $this->fotos()->count();
    }
}
