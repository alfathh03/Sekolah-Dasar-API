<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Tambahkan ini:
    protected $fillable = ['nama', 'nip', 'mapel', 'alamat'];

}
