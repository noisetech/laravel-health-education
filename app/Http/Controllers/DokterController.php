<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::with(['user'])->orderBy('nama_lengkap', 'asc')->paginate(5);

        return view('pages.dokter.index', compact('dokter'));
    }

    public function tambah()
    {
        return view('pages.dokter.tambah');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'spesialis' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg|max:2048'
        ]);


    }


    public function hapus($id)
    {
        $dokter = Dokter::findOrFail($id);

        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
}
