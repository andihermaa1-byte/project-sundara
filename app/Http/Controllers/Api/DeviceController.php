<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CardActivityLog;
use App\Models\LearningSession;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // Menerima scan dari ESP32 (FR-10)
    public function handleScan(Request $request)
    {
        $request->validate([
            'slot_position' => 'required|integer',
            'card_uid'      => 'required|string',
        ]);

        // Cari sesi aktif saat ini
        $activeSession = LearningSession::where('status', 'active')->first();

        if (! $activeSession) {
            return response()->json([
                'status'  => 'ignored',
                'message' => 'Tidak ada sesi aktif. Data scan diabaikan.'
            ], 200);
        }

        // Simpan Log Aktivitas Pembacaan Kartu
        $log = CardActivityLog::create([
            'learning_session_id' => $activeSession->id,
            'slot_position'       => $request->slot_position,
            'card_uid'            => $request->card_uid,
            'is_correct'          => false, // Nanti akan dicocokkan dengan kunci jawaban
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data scan RFID berhasil direkam',
            'data'    => $log
        ], 200);
    }
}