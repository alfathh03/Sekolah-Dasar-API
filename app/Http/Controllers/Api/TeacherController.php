<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::all();
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:100',
        'nip' => 'required|string|unique:teachers,nip',
        'mapel' => 'required|string|max:100',
        'alamat' => 'nullable|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
    ]);

    $teacher = Teacher::create($validated);

    return response()->json([
        'message' => 'Guru berhasil ditambahkan',
        'data' => $teacher
    ], 201);
}

        // Validasi data (opsional tapi direkomendasikan)
 

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json($teacher);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return response()->json([
            'message' => 'Guru berhasil diupdate',
            'data' => $teacher
        ]);
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json(['message' => 'Guru berhasil dihapus']);
    }
}
