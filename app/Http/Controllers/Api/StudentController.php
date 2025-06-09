<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;



class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'kelas' => 'required',
        'umur' => 'required|integer',
    ]);

    \Log::info('Input Data:', $request->all());

    $student = Student::create($request->all());

    \Log::info('Created Student:', $student->toArray());

    return response()->json($student, 201);
}


    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        return $student;
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        $student->update($request->all());
        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        $student->delete();
        return response()->json(['message' => 'Siswa dihapus']);
    }
}
