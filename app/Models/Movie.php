<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    // Kolom yang boleh diisi melalui form
    protected $fillable = ['title', 'genre', 'status', 'user_id'];

    /**
     * Relasi balik ke User
     * Setiap film dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}