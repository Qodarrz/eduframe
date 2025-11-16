<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriPageController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('fotos')->latest()->get();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'deskripsi' => 'nullable|string'
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'deskripsi' => 'nullable|string'
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    public function show(Kategori $kategori)
    {
        $fotos = $kategori->fotos()->latest()->paginate(12);
        return view('kategori.show', compact('kategori', 'fotos'));
    }
}
