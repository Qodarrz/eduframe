<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoComment extends Model
{
    protected $fillable = [
        'foto_id',
        'name',
        'email',
        'comment',
        'ip_address',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }
}
