<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kategori_id' => $this->kategori_id,
            'kategori' => $this->whenLoaded('kategori', function () {
                return [
                    'id' => $this->kategori->id,
                    'nama' => $this->kategori->nama,
                    'slug' => $this->kategori->slug,
                    'icon' => $this->kategori->icon,
                ];
            }),
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'path' => $this->path,
            'url' => $this->url, // menggunakan accessor dari model
            'alt_text' => $this->alt_text,
            'is_featured' => $this->is_featured,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
