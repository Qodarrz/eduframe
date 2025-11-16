<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'is_published',
        'urutan'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Auto-generate slug dari judul
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->judul);
            }
        });
        
        static::updating(function ($page) {
            if ($page->isDirty('judul') && empty($page->slug)) {
                $page->slug = Str::slug($page->judul);
            }
        });
    }

    // Scope: Hanya halaman yang dipublish
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('urutan');
    }
}
