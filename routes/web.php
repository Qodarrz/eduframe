<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriPageController;
use App\Http\Controllers\FotoPageController;
use Illuminate\Support\Facades\Route;

// ========================================
// GUEST ROUTES (Public Access)
// ========================================
Route::get('/', function () {
    $featuredPhotos = \App\Models\Foto::with('kategori')
        ->where('is_featured', true)
        ->latest()
        ->take(4)
        ->get();

    $totalFotos = \App\Models\Foto::count();
    $totalKategori = \App\Models\Kategori::count();
    $latestInformasi = \App\Models\Informasi::published()->latest()->take(3)->get();

    return view('guest.home', compact('featuredPhotos', 'totalFotos', 'totalKategori', 'latestInformasi'));
})->name('home');

Route::get('/info', function () {
    $informasis = \App\Models\Informasi::published()->ordered()->get();
    return view('guest.informasi', compact('informasis'));
})->name('info');

Route::get('/galeri', function () {
    return view('guest.galeri');
})->name('galeri');

Route::get('/galeri/{id}', function ($id) {
    $foto = \App\Models\Foto::with('kategori')->findOrFail($id);
    return view('guest.foto-detail', compact('foto'));
})->name('galeri.detail');

Route::get('/tenaga-pendidikan', function () {
    $tenagaPendidikan = \App\Models\TenagaPendidikan::active()->orderByName()->get();
    return view('guest.tenaga-pendidikan', compact('tenagaPendidikan'));
})->name('tenaga-pendidikan');

Route::get('/news', function () {
    $query = \App\Models\Berita::published();

    if ($kategori = request('kategori')) {
        $query->where('kategori', $kategori);
    }

    if ($search = request('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('konten', 'like', '%' . $search . '%');
        });
    }

    $beritas = $query->latest()->paginate(9);
    return view('guest.berita', compact('beritas'));
})->name('guest.berita');

Route::get('/news/{id}', function ($id) {
    $berita = \App\Models\Berita::published()->findOrFail($id);
    $latestBerita = \App\Models\Berita::published()->latest()->take(5)->get();
    return view('guest.berita-detail', compact('berita', 'latestBerita'));
})->name('guest.berita.detail');

// ========================================
// AUTHENTICATED ROUTES
// ========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Resource Controllers
    Route::resources([
        'kategori' => KategoriPageController::class,
        'foto' => FotoPageController::class,
        'informasi' => \App\Http\Controllers\InformasiController::class,
        'berita' => \App\Http\Controllers\BeritaController::class,
    ]);
    Route::resource('admin/tenaga-pendidikan', \App\Http\Controllers\TenagaPendidikanController::class)->names([
        'index' => 'admin.tenaga-pendidikan.index',
        'create' => 'admin.tenaga-pendidikan.create',
        'store' => 'admin.tenaga-pendidikan.store',
        'show' => 'admin.tenaga-pendidikan.show',
        'edit' => 'admin.tenaga-pendidikan.edit',
        'update' => 'admin.tenaga-pendidikan.update',
        'destroy' => 'admin.tenaga-pendidikan.destroy',
    ]);

    // User Management
    Route::resource('admin/users', \App\Http\Controllers\Admin\UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Test Upload
    Route::get('/test-upload', function () {
        return view('test-upload');
    })->name('test.upload');

    Route::post('/test-upload', function (\Illuminate\Http\Request $request) {
        try {
            if (!$request->hasFile('foto')) {
                return back()->with('error', 'No file uploaded');
            }

            $file = $request->file('foto');
            if (!$file->isValid()) {
                return back()->with('error', 'File is not valid');
            }

            $fileName = time() . '_test.' . $file->extension();

            // Method 1: storeAs
            $path = $file->storeAs('public/uploads', $fileName);
            $fullPath = storage_path('app/' . $path);

            if (file_exists($fullPath)) {
                return back()->with('success', 'SUCCESS! File saved: ' . $fileName . ' (' . filesize($fullPath) . ' bytes)');
            }

            // Method 2: move() if storeAs fails
            $destinationPath = storage_path('app/public/uploads');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);

            $file->move($destinationPath, $fileName);
            $movedPath = $destinationPath . '/' . $fileName;

            if (file_exists($movedPath)) {
                return back()->with('success', 'SUCCESS (via move)! File saved: ' . $fileName . ' (' . filesize($movedPath) . ' bytes)');
            }

            return back()->with('error', 'Both methods failed. Temp file: ' . $file->getPathname());

        } catch (\Exception $e) {
            return back()->with('error', 'Exception: ' . $e->getMessage());
        }
    })->name('test.upload.post');
});

require __DIR__ . '/auth.php';
