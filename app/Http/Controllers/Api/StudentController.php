<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('classRoom');
        
        if ($request->has('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $query->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_room_id'  => 'required|exists:class_rooms,id',
            'student_number' => 'required|string',
            'name'           => 'required|string'
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Siswa berhasil ditambahkan',
            'data'    => $student
        ], 201);
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Data siswa berhasil dihapus']);
    }
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $request->validate([
            'class_room_id'  => 'required|exists:class_rooms,id',
            'student_number' => 'required|string',
            'name'           => 'required|string'
        ]);

        $student->update($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Data siswa berhasil diperbarui',
            'data'    => $student
        ]);
    }
}