<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MahasiswaImport extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $fillable = [
        'prodi',
        'nim',
        'nama',
        'jk',
        'jalur',
        'semester',
        'kelas',
    ];
}
