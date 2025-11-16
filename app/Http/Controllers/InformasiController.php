<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class InformasiController extends Controller
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
        $informasis = Informasi::ordered()->paginate(10);
        return view('informasi.index', compact('informasis'));
    }

    public function create()
    {
        return view('informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:visi,misi,sejarah,jurusan,umum',
            'urutan' => 'nullable|integer',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'is_published' => 'nullable|boolean'
        ]);

        $gambarUrl = null;
        if ($request->hasFile('gambar')) {
            $uploadedFile = $request->file('gambar')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'informasi',
                'public_id' => pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME)
            ]);
            $gambarUrl = $result['secure_url'] ?? null;
        }

        Informasi::create([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'urutan' => $request->urutan ?? 0,
            'konten' => $request->konten,
            'gambar' => $gambarUrl,
            'is_published' => $request->has('is_published') ? true : false
        ]);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function edit(Informasi $informasi)
    {
        return view('informasi.edit', compact('informasi'));
    }

    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:visi,misi,sejarah,jurusan,umum',
            'urutan' => 'nullable|integer',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'is_published' => 'nullable|boolean'
        ]);

        $informasi->judul = $request->judul;
        $informasi->tipe = $request->tipe;
        $informasi->urutan = $request->urutan ?? 0;
        $informasi->konten = $request->konten;
        $informasi->is_published = $request->has('is_published') ? true : false;

        if ($request->hasFile('gambar')) {
            // Upload gambar baru ke Cloudinary
            $uploadedFile = $request->file('gambar')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'informasi',
                'public_id' => pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME),
                'overwrite' => true
            ]);
            $informasi->gambar = $result['secure_url'] ?? $informasi->gambar;
        }

        $informasi->save();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui!');
    }

    public function destroy(Informasi $informasi)
    {
        // Optional: bisa hapus file dari Cloudinary jika ingin bersih
        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus!');
    }
}
