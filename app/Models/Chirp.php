<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        // 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);// aqui usamos el metodo belongsToy que define una que los chirps pertenecen a un user 
    }
}
