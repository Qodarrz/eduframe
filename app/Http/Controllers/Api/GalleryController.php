<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FotoResource;
use App\Http\Resources\KategoriResource;
use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Get all photos for gallery (public access)
     */
    public function index(Request $request)
    {
        $query = Foto::with('kategori')->latest();

        // Filter by kategori slug
        if ($request->has('kategori')) {
            $kategori = Kategori::where('slug', $request->kategori)->first();
            if ($kategori) {
                $query->where('kategori_id', $kategori->id);
            }
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $fotos = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'message' => 'Gallery berhasil diambil',
            'data' => FotoResource::collection($fotos),
            'meta' => [
                'current_page' => $fotos->currentPage(),
                'last_page' => $fotos->lastPage(),
                'per_page' => $fotos->perPage(),
                'total' => $fotos->total(),
            ]
        ]);
    }

    /**
     * Get featured photos for homepage
     */
    public function featured()
    {
        $fotos = Foto::with('kategori')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Foto unggulan berhasil diambil',
            'data' => FotoResource::collection($fotos)
        ]);
    }

    /**
     * Get all categories with photo count
     */
    public function categories()
    {
        $kategoris = Kategori::withCount('fotos')
            ->having('fotos_count', '>', 0)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diambil',
            'data' => KategoriResource::collection($kategoris)
        ]);
    }

    /**
     * Get photos by category slug
     */
    public function byCategory($slug, Request $request)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();

        $fotos = Foto::with('kategori')
            ->where('kategori_id', $kategori->id)
            ->latest()
            ->paginate($request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'message' => "Foto kategori {$kategori->nama} berhasil diambil",
            'kategori' => new KategoriResource($kategori),
            'data' => FotoResource::collection($fotos),
            'meta' => [
                'current_page' => $fotos->currentPage(),
                'last_page' => $fotos->lastPage(),
                'per_page' => $fotos->perPage(),
                'total' => $fotos->total(),
            ]
        ]);
    }

    /**
     * Get single photo detail
     */
    public function show($id)
    {
        $foto = Foto::with('kategori')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail foto berhasil diambil',
            'data' => new FotoResource($foto)
        ]);
    }
}
