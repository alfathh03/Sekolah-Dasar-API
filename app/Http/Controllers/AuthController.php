<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting untuk Auth::attempt()
// use App\Models\User; // Tidak wajib diimport jika hanya untuk Auth::user()
// use Illuminate\Support\Facades\Hash; // Diperlukan jika Anda juga punya register di sini

class AuthController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba autentikasi user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Kredensial tidak valid.'
            ], 401); // Respon HTTP 401: Unauthorized
        }

        // Jika autentikasi berhasil, dapatkan user
        $user = Auth::user();

        // Buat token Sanctum untuk user ini
        // Anda bisa memberi nama token yang deskriptif, misal 'api_token'
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user, // Mengembalikan data user (tanpa password)
            'access_token' => $token,
            'token_type' => 'Bearer', // Standar untuk token API
        ]);
    }

    /**
     * Log the user out (revoke the token).
     */
    public function logout(Request $request)
    {
        // Menghapus token saat ini yang digunakan oleh user
        // Ini akan membuat token tersebut tidak valid lagi
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Berhasil logout']);
    }

    /**
     * Get the authenticated user's details.
     */
    public function user(Request $request)
    {
        // Mengembalikan data user yang sedang terautentikasi melalui token
        return response()->json($request->user());
    }

    // Anda bisa menambahkan metode lain seperti register, forgot password, dll.
    // public function register(Request $request) { ... }
}