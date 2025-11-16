<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\FotoLike;
use App\Models\FotoComment;
use Illuminate\Http\Request;

class FotoInteractionController extends Controller
{
    // Toggle like untuk foto
    public function toggleLike(Request $request, $fotoId)
    {
        $foto = Foto::findOrFail($fotoId);
        $ipAddress = $request->ip();
        
        // Check if user already liked this foto
        $existingLike = FotoLike::where('foto_id', $fotoId)
            ->where('ip_address', $ipAddress)
            ->first();
        
        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
        } else {
            // Like
            FotoLike::create([
                'foto_id' => $fotoId,
                'ip_address' => $ipAddress,
                'user_agent' => $request->userAgent(),
            ]);
            $liked = true;
        }
        
        $likesCount = $foto->likes()->count();
        
        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount,
        ]);
    }
    
    // Submit comment
    public function storeComment(Request $request, $fotoId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);
        
        $foto = Foto::findOrFail($fotoId);
        
        $comment = FotoComment::create([
            'foto_id' => $fotoId,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'ip_address' => $request->ip(),
            'is_approved' => false, // Needs admin approval
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Komentar Anda telah dikirim dan menunggu persetujuan admin.',
        ]);
    }
    
    // Get comments for a foto
    public function getComments($fotoId)
    {
        $comments = FotoComment::where('foto_id', $fotoId)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }
}
