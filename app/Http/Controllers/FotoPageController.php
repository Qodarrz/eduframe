<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class FotoPageController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        // Inisialisasi Cloudinary
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }

    public function index()
    {
        $fotos = Foto::with('kategori')->orderBy('created_at', 'desc')->paginate(12);
        return view('foto.index', compact('fotos'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('foto.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'path' => 'required|image|mimes:jpeg,png,jpg,webp|max:15360',
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean'
        ]);

        $fotoUrl = null;
        if ($request->hasFile('path')) {
            $uploadedFile = $request->file('path')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'foto',
                'public_id' => pathinfo($request->file('path')->getClientOriginalName(), PATHINFO_FILENAME)
            ]);
            $fotoUrl = $result['secure_url'] ?? null;
        }

        Foto::create([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'path' => $fotoUrl,
            'alt_text' => $request->alt_text ?? $request->judul,
            'is_featured' => $request->has('is_featured') ? true : false
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diupload!');
    }

    public function edit(Foto $foto)
    {
        $kategoris = Kategori::all();
        return view('foto.edit', compact('foto', 'kategoris'));
    }

    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean'
        ]);

        $foto->kategori_id = $request->kategori_id;
        $foto->judul = $request->judul;
        $foto->deskripsi = $request->deskripsi;
        $foto->alt_text = $request->alt_text ?? $request->judul;
        $foto->is_featured = $request->has('is_featured') ? true : false;

        if ($request->hasFile('path')) {
            $uploadedFile = $request->file('path')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'foto',
                'public_id' => pathinfo($request->file('path')->getClientOriginalName(), PATHINFO_FILENAME),
                'overwrite' => true
            ]);
            $foto->path = $result['secure_url'] ?? $foto->path;
        }

        $foto->save();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Foto $foto)
    {
        // Optional: bisa hapus dari Cloudinary jika ingin bersih
        $foto->delete();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus!');
    }
}
