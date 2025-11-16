<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidikan;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class TenagaPendidikanController extends Controller
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
        $tenagaPendidikan = TenagaPendidikan::orderBy('jenis', 'asc')
            ->orderBy('nama', 'asc')
            ->paginate(20);

        return view('admin.tenaga-pendidikan.index', compact('tenagaPendidikan'));
    }

    public function create()
    {
        return view('admin.tenaga-pendidikan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jenis' => 'required|in:guru,staf',
            'jabatan' => 'required|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:15360',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'bidang_keahlian' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $uploadedFile = $request->file('foto')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'tenaga-pendidikan',
                'public_id' => pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME)
            ]);
            $validated['foto'] = $result['secure_url'] ?? null;
        }

        TenagaPendidikan::create($validated);

        return redirect()->route('admin.tenaga-pendidikan.index')
            ->with('success', 'Data tenaga pendidikan berhasil ditambahkan!');
    }

    public function show(TenagaPendidikan $tenagaPendidikan)
    {
        return view('admin.tenaga-pendidikan.show', compact('tenagaPendidikan'));
    }

    public function edit(TenagaPendidikan $tenagaPendidikan)
    {
        return view('admin.tenaga-pendidikan.edit', compact('tenagaPendidikan'));
    }

    public function update(Request $request, TenagaPendidikan $tenagaPendidikan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jenis' => 'required|in:guru,staf',
            'jabatan' => 'required|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:15360',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'bidang_keahlian' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            // Upload foto baru ke Cloudinary
            $uploadedFile = $request->file('foto')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'tenaga-pendidikan',
                'public_id' => pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME),
                'overwrite' => true
            ]);
            $validated['foto'] = $result['secure_url'] ?? $tenagaPendidikan->foto;
        }

        $tenagaPendidikan->update($validated);

        return redirect()->route('admin.tenaga-pendidikan.index')
            ->with('success', 'Data tenaga pendidikan berhasil diperbarui!');
    }

    public function destroy(TenagaPendidikan $tenagaPendidikan)
    {
        // Optional: bisa hapus foto di Cloudinary jika ingin bersih
        $tenagaPendidikan->delete();

        return redirect()->route('admin.tenaga-pendidikan.index')
            ->with('success', 'Data tenaga pendidikan berhasil dihapus!');
    }
}
