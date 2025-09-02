<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians'; // nama tabel di database

    protected $fillable = [
        'user_id',
        'pertanyaan_index',
        'nilai',
    ];

    // Optional: jika kamu ingin relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
