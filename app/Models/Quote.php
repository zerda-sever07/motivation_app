<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    // Veri tabanına toplu veri girişine izin verdiğimiz alanlar
    protected $fillable = ['user_id', 'content', 'author, likes'];

    // Her söz bir kullanıcıya aittir (İlişki tanımlama)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
