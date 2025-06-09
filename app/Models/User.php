<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail; // Untuk verifikasi email (opsional, tapi bagus)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail // Implement ini jika pakai verifikasi email
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Penting untuk otorisasi berbasis peran
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Akan otomatis hash password saat di-set
    ];

    // Relasi untuk siswa melihat nilainya sendiri (jika User bisa jadi student)
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
}