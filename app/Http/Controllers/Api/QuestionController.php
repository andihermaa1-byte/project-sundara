<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function indexCategories()
    {
        $categories = Category::withCount('questions')->get();
        $totalQuestions = Question::count();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'categories'      => $categories,
                'total_questions' => $totalQuestions,
            ],
        ]);
    }

    public function index(Request $request)
    {
        $query = Question::with('category');

        if ($request->filled('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('word_target', 'like', "%{$search}%")
                  ->orWhere('sundanese_text', 'like', "%{$search}%");
            });
        }

        $questions = $query->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $questions,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'word_target'    => 'required|string|max:100',
            'sundanese_text' => 'nullable|string|max:100',
            'rfid_sequence'  => 'required|array|min:1',
            'difficulty'     => 'nullable|integer|min:1|max:3',
        ]);

        $question = Question::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Soal berhasil ditambahkan.',
            'data'    => $question->load('category'),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'word_target'    => 'required|string|max:100',
            'sundanese_text' => 'nullable|string|max:100',
            'rfid_sequence'  => 'required|array|min:1',
            'difficulty'     => 'nullable|integer|min:1|max:3',
        ]);

        $question->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Soal berhasil diperbarui.',
            'data'    => $question->load('category'),
        ]);
    }

    public function destroy($id)
    {
        Question::findOrFail($id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Soal berhasil dihapus.',
        ]);
    }
}