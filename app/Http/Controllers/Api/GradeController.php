<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return Grade::with(['student', 'teacher'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'mapel' => 'required|string|max:100',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $grade = Grade::create($validated);

        return response()->json([
            'message' => 'Nilai berhasil ditambahkan',
            'data' => $grade
        ], 201);
    }

    public function show($id)
    {
        return Grade::with(['student', 'teacher'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update($request->all());

        return response()->json([
            'message' => 'Nilai berhasil diperbarui',
            'data' => $grade
        ]);
    }

    public function destroy($id)
    {
        Grade::destroy($id);
        return response()->json(['message' => 'Nilai berhasil dihapus']);
    }
}

