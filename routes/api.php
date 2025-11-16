<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\FotoController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\AuthController;

// ========================================
// AUTH ROUTES
// ========================================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// ========================================
// PUBLIC ROUTES (Guest Access)
// ========================================

// Gallery - Public access untuk homepage
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index']); // All photos with filter
    Route::get('/featured', [GalleryController::class, 'featured']); // Featured photos
    Route::get('/categories', [GalleryController::class, 'categories']); // All categories
    Route::get('/category/{slug}', [GalleryController::class, 'byCategory']); // Photos by category
    Route::get('/{id}', [GalleryController::class, 'show']); // Single photo detail
});

// Pages - Public access untuk halaman statis
Route::get('/pages', [PageController::class, 'index']); // Published pages only
Route::get('/pages/{slugOrId}', [PageController::class, 'show']); // Single page

// ========================================
// ADMIN ROUTES (Protected)
// ========================================

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    
    // Kategori Management
    Route::apiResource('kategoris', KategoriController::class);
    
    // Foto Management
    Route::apiResource('fotos', FotoController::class);
    
    // Page Management
    Route::apiResource('pages', PageController::class)->except(['index', 'show']);
    
});

// User info (authenticated)
Route::get('/user', function (Request $request) {
    return response()->json([
        'success' => true,
        'data' => $request->user()
    ]);
})->middleware('auth:sanctum');
