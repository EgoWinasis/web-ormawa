<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agenda;
use Cviebrock\EloquentSluggable\Sluggable;

// { --update-login-- }
use Illuminate\Foundation\Auth\User as Authenticatable;
class Anggota extends Authenticatable  
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = ['id'];

    public function agendas() {
        return $this->belongsToMany(Agenda::class, 'anggota_agenda');
    }
}