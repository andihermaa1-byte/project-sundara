<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RfidCard;
use Illuminate\Http\Request;

class RfidCardController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => RfidCard::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'uid' => 'required|string|unique:rfid_cards,uid',
            'name' => 'required|string',
            'char_sundanese' => 'required|string',
            'type' => 'required|in:ngalagena,swara,rarangken',
            'latin' => 'required|string',
        ]);

        $card = RfidCard::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Kartu RFID berhasil didaftarkan',
            'data' => $card
        ], 201);
    }

    public function destroy($id)
    {
        RfidCard::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Kartu RFID berhasil dihapus'
        ]);
    }
}