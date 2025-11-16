<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::query();

        // Filter published only for non-admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            $query->where('is_published', true);
        }

        $pages = $query->orderBy('urutan')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data halaman berhasil diambil',
            'data' => PageResource::collection($pages)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'is_published' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $page = Page::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Halaman berhasil ditambahkan',
            'data' => new PageResource($page)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($slugOrId)
    {
        // Cari berdasarkan slug atau ID
        $page = Page::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->first();

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Halaman tidak ditemukan'
            ], 404);
        }

        // Cek published untuk non-admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            if (!$page->is_published) {
                return response()->json([
                    'success' => false,
                    'message' => 'Halaman tidak tersedia'
                ], 403);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail halaman berhasil diambil',
            'data' => new PageResource($page)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'is_published' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $page->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Halaman berhasil diperbarui',
            'data' => new PageResource($page)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Halaman berhasil dihapus'
        ]);
    }
}
