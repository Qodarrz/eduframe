<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoLike extends Model
{
    protected $fillable = [
        'foto_id',
        'ip_address',
        'user_agent',
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }
}
