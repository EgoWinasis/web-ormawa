<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Agenda extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
     protected $table = 'agendas';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'anggota_agenda');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_kegiatan'
            ]
        ];
    }
     /**
      * The attributes that should be hidden for serialization.
      *
      * @var array<int, string>
      */
     
}
