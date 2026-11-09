<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => ClassRoom::withCount('students')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'academic_year' => 'nullable|string'
        ]);

        $class = ClassRoom::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Kelas berhasil ditambahkan',
            'data'    => $class
        ], 201);
    }

    public function show($id)
    {
        $class = ClassRoom::with('students')->findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $class]);
    }

    public function destroy($id)
    {
        ClassRoom::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Kelas berhasil dihapus']);
    }
}