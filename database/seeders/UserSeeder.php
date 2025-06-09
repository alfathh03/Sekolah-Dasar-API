<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'coba5',
            'email' => 'coba5@gmail.com',
            'password' => Hash::make('apacoba') // jangan lupa enkripsi password
        ]);
    }
}
