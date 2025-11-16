<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FotoResource;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Foto::with('kategori')->latest();

        // Filter by kategori
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter featured
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $fotos = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'message' => 'Data foto berhasil diambil',
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'path' => 'required|image|mimes:jpeg,png,jpg,webp|max:15360', // max 15MB
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload foto
        $file = $request->file('path');
        $fileName = time() . '_' . uniqid() . '.' . $file->extension();
        
        $destinationPath = storage_path('app/public/uploads');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $fileName);

        $foto = Foto::create([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'path' => $fileName,
            'alt_text' => $request->alt_text ?? $request->judul,
            'is_featured' => $request->is_featured ?? false,
        ]);

        $foto->load('kategori');

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diupload',
            'data' => new FotoResource($foto)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        $foto->load('kategori');

        return response()->json([
            'success' => true,
            'message' => 'Detail foto berhasil diambil',
            'data' => new FotoResource($foto)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360', // max 15MB
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update data
        $foto->kategori_id = $request->kategori_id;
        $foto->judul = $request->judul;
        $foto->deskripsi = $request->deskripsi;
        $foto->alt_text = $request->alt_text ?? $request->judul;
        $foto->is_featured = $request->is_featured ?? false;

        // Jika ada upload foto baru
        if ($request->hasFile('path')) {
            // Hapus foto lama
            $oldPath = storage_path('app/public/uploads/' . $foto->path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload foto baru
            $file = $request->file('path');
            $fileName = time() . '_' . uniqid() . '.' . $file->extension();
            
            $destinationPath = storage_path('app/public/uploads');
            $file->move($destinationPath, $fileName);
            
            $foto->path = $fileName;
        }

        $foto->save();
        $foto->load('kategori');

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui',
            'data' => new FotoResource($foto)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        // Hapus file foto
        $filePath = storage_path('app/public/uploads/' . $foto->path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        // Hapus data dari database
        $foto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil dihapus'
        ]);
    }
}
