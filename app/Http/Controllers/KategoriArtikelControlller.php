<?php

namespace App\Http\Controllers;

use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriArtikelControlller extends Controller
{
    public function index()
    {
        $kategori_artikel = KategoriArtikel::latest()->paginate(5);

        return view('pages.kategori-artikel.index', compact('kategori_artikel'));
    }


    public function tambah()
    {
        return view('pages.kategori-artikel.tambah');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required'
        ], [
            'kategori.required' => 'kategori tidak boleh kosong'
        ]);


        $kategori_artikel = new KategoriArtikel();
        $kategori_artikel->kategori = $request->kategori;
        $kategori_artikel->slug = Str::slug($request->kategori);
        $kategori_artikel->save();

        return redirect()->route('kategori-artikel')->with('status', 'Data berhasil ditambah');
    }


    public function edit($id)
    {
        $kategori_artikel = KategoriArtikel::find($id);

        return view('pages.kategori-artikel.edit', [
            'kategori_artikel' => $kategori_artikel
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kategori' => 'required'
        ], [
            'kategori.required' => 'kategori tidak boleh kosong'
        ]);


        $kategori_artikel = KategoriArtikel::findOrFail($id);
        $kategori_artikel->kategori = $request->kategori;
        $kategori_artikel->slug = Str::slug($request->kategori);
        $kategori_artikel->save();

        return redirect()->route('kategori-artikel')->with('status', 'Data berhasil diubah');
    }


    public function hapus($id)
    {
        $kategori_artikel = KategoriArtikel::findorFail($id);

        $kategori_artikel->delete();

        return redirect()->route('kategori-artikel')->with('status', 'Data berhasil dihapus');
    }
}
