<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    // Memulai sesi baru (FR-06)
    public function startSession(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        // Cek jika masih ada sesi aktif
        $activeSession = LearningSession::where('status', 'active')->first();
        if ($activeSession) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Masih ada sesi aktif. Harap akhiri sesi sebelumnya terlebih dahulu.'
            ], 400);
        }

        $session = LearningSession::create([
            'session_code' => 'SNDR-' . strtoupper(Str::random(6)),
            'student_id'   => $request->student_id,
            'status'       => 'active',
            'started_at'   => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Sesi pembelajaran berhasil dimulai',
            'data'    => $session->load('student')
        ], 201);
    }

    // Mengakhiri sesi aktif (FR-07)
    public function endSession($id)
    {
        $session = LearningSession::findOrFail($id);
        $session->update([
            'status'   => 'completed',
            'ended_at' => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Sesi pembelajaran telah diakhiri',
            'data'    => $session
        ]);
    }

    // Mendapatkan status sesi aktif saat ini
    public function currentSession()
    {
        $session = LearningSession::where('status', 'active')->with(['student', 'logs'])->first();
        return response()->json([
            'status' => 'success',
            'data'   => $session
        ]);
    }
}