<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class BeritaController extends Controller
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

    public function index(Request $request)
    {
        $query = Berita::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('konten', 'like', '%' . $searchTerm . '%');
            });
        }
        
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori', $request->kategori);
        }
        
        $beritas = $query->orderByRaw("
            CASE 
                WHEN kategori = 'kehilangan' THEN 1
                WHEN kategori = 'ditemukan' THEN 2
                WHEN kategori = 'prestasi' THEN 3
                ELSE 4
            END
        ")->latest()->paginate(10);
        
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|in:kehilangan,ditemukan,prestasi,prestasi sekolah,agenda',
            'lokasi_terakhir' => 'required_if:kategori,kehilangan|string|max:255',
            'lokasi' => 'required_if:kategori,ditemukan|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'is_published' => 'nullable|boolean'
        ]);

        $gambarUrl = null;
        if ($request->hasFile('gambar')) {
            $uploadedFile = $request->file('gambar')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'berita',
                'public_id' => pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME)
            ]);
            $gambarUrl = $result['secure_url'] ?? null;
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'lokasi_terakhir' => $request->lokasi_terakhir,
            'lokasi' => $request->lokasi,
            'gambar' => $gambarUrl,
            'is_published' => $request->has('is_published') ? true : false
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|in:kehilangan,ditemukan,prestasi,prestasi sekolah,agenda',
            'lokasi_terakhir' => 'required_if:kategori,kehilangan|string|max:255',
            'lokasi' => 'required_if:kategori,ditemukan|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'is_published' => 'nullable|boolean'
        ]);

        $berita->judul = $request->judul;
        $berita->konten = $request->konten;
        $berita->kategori = $request->kategori;
        $berita->lokasi_terakhir = $request->lokasi_terakhir;
        $berita->lokasi = $request->lokasi;
        $berita->is_published = $request->has('is_published') ? true : false;

        if ($request->hasFile('gambar')) {
            $uploadedFile = $request->file('gambar')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'berita',
                'public_id' => pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME),
                'overwrite' => true
            ]);
            $berita->gambar = $result['secure_url'] ?? $berita->gambar;
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        // Optional: bisa hapus dari Cloudinary juga jika perlu
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
