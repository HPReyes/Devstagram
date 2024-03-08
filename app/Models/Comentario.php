<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'comentario',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
