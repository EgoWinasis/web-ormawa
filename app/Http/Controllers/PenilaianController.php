<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenilaianController extends Controller
{
    public function create($user_id)
    {
        return view('admin.penilaian.index', compact('user_id'));
    }
    public function ajaxStore(Request $request, $user_id)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|integer|min:0|max:9',
            'nilai' => 'required|integer|min:1|max:10',
        ]);

        // Simpan ke database (tabel penilaians, bisa disesuaikan)
        \App\Models\Penilaian::updateOrCreate(
            [
                'user_id' => $user_id,
                'pertanyaan_index' => $validated['pertanyaan']
            ],
            [
                'nilai' => $validated['nilai']
            ]
        );

        return response()->json(['message' => 'Nilai berhasil disimpan.']);
    }

}
