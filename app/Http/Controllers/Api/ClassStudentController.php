<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassStudentController extends Controller
{
    // === MANAJEMEN KELAS ===
    public function indexClasses()
    {
        $classes = ClassRoom::withCount([
            'students',
            'students as menguasai_count' => fn($q) => $q->where('mastery_status', 'menguasai'),
            'students as rfid_ready_count' => fn($q) => $q->whereNotNull('rfid_uid'),
        ])->orderBy('name')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $classes,
        ]);
    }

    public function storeClass(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:50|unique:class_rooms,name',
            'academic_year' => 'required|string|max:20',
        ]);

        $classRoom = ClassRoom::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kelas berhasil ditambahkan.',
            'data'    => $classRoom,
        ], 201);
    }

    public function destroyClass($id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kelas berhasil dihapus.',
        ]);
    }

    // === MANAJEMEN SISWA & KARTU RFID ===
    public function indexStudents(Request $request)
    {
        $query = Student::with('classRoom');

        // Pastikan filter kelas hanya dijalankan jika nilainya ada dan bukan string kosong/null
        if ($request->filled('class_room_id') && $request->class_room_id !== '' && $request->class_room_id !== 'null') {
            $query->where('class_room_id', $request->class_room_id);
        }

        if ($request->filled('mastery_status')) {
            $query->where('mastery_status', $request->mastery_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%")
                  ->orWhere('rfid_uid', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy('class_room_id')->orderBy('name')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $students,
        ]);
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'class_room_id'  => 'required|exists:class_rooms,id',
            'student_number' => 'required|string|max:30|unique:students,student_number',
            'name'           => 'required|string|max:120',
            'rfid_uid'       => 'nullable|string|max:50|unique:students,rfid_uid',
            'mastery_status' => 'nullable|in:menguasai,cukup,belum',
            'weakness_focus' => 'nullable|string|max:120',
        ]);

        $validated['mastery_status'] = $validated['mastery_status'] ?? 'belum';
        $student = Student::create($validated)->load('classRoom');

        return response()->json([
            'status'  => 'success',
            'message' => 'Data siswa berhasil didaftarkan.',
            'data'    => $student,
        ], 201);
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'class_room_id'  => 'required|exists:class_rooms,id',
            'student_number' => 'required|string|max:30|unique:students,student_number,' . $student->id,
            'name'           => 'required|string|max:120',
            'rfid_uid'       => 'nullable|string|max:50|unique:students,rfid_uid,' . $student->id,
            'mastery_status' => 'required|in:menguasai,cukup,belum',
            'weakness_focus' => 'nullable|string|max:120',
        ]);

        $student->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data siswa & kartu RFID diperbarui.',
            'data'    => $student->load('classRoom'),
        ]);
    }

    public function destroyStudent($id)
    {
        Student::findOrFail($id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data siswa berhasil dihapus.',
        ]);
    }
}