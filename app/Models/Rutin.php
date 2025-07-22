<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutin extends Model
{
    use HasFactory;
    protected $table = 'rutins';
    protected $guarded = ['id'];

}
