<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaPendidikan extends Model
{
    protected $table = 'tenaga_pendidikan';
    
    protected $fillable = [
        'nama',
        'nip',
        'jenis',
        'jabatan',
        'pendidikan',
        'foto',
        'email',
        'telepon',
        'bidang_keahlian',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk filter guru
    public function scopeGuru($query)
    {
        return $query->where('jenis', 'guru');
    }

    // Scope untuk filter staf
    public function scopeStaf($query)
    {
        return $query->where('jenis', 'staf');
    }

    // Scope untuk yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk urut berdasarkan nama (abjad)
    public function scopeOrderByName($query)
    {
        return $query->orderBy('nama', 'asc');
    }
}
