<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class TanyaJawabController extends Controller
{
    public function index()
    {
        $doker = Dokter::where('status', 'aktif')->get();

        return view('pages.tanya-jawab.index', compact('doker'));
    }

    public function getMessage($dokterId)
    {
        $messages = Pertanyaan::where(function ($query) use ($dokterId) {
            $query->where('user_id', auth()->id())
                ->where('dokter_id', $dokterId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'pesan' => 'required|string'
        ]);

        $message = Pertanyaan::create([
            'user_id' => auth()->id(),
            'dokter_id' => $request->dokter_id,
            'pesan' => $request->pesan,
            'sender_type' => 'user'
        ]);

        return response()->json($message);
    }
}
