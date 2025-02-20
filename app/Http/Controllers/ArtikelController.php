<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\TagArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::with(['tag_artikel', 'kategori_artikel'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('pages.artikel.index', compact('artikel'));
    }

    public function tambah()
    {
        $kategori_artikel = KategoriArtikel::all();
        $tag_artikel = TagArtikel::all();
        return view('pages.artikel.tambah', [
            'kategori_artikel' => $kategori_artikel,
            'tag_artikel' => $tag_artikel,
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'gambar' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'kategori_artikel' => 'required',
            'tag_artikel' => 'required',
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $artikel = new Artikel();
        $artikel->kategeri_artikel_id = $request->kategori_artikel;
        $artikel->tag_artikel = $request->tag_artikel;
        $artikel->judul = $request->judul;
        $artikel->isi = $request->isi;
        $artikel->status = $request->status;
        $artikel->create_by = Auth::user()->name;
        $artikel->save();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_name = $name . '.' . time() . $extension;
            $path = $file->storeAs('assets/artikel/', $file_name, 'public');
            $artikel->gambar = $path;
            $artikel->save();
        }

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategori_artikel = KategoriArtikel::all();
        $tag_artikel = TagArtikel::all();

        return view('pages.artikel.edit', [
            'artikel' => $artikel,
            'kategori_artikel' => $kategori_artikel,
            'tag_artikel' => $tag_artikel,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'gambar' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'kategori_artikel' => 'required',
            'tag_artikel' => 'required',
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->kategeri_artikel_id = $request->kategori_artikel;
        $artikel->tag_artikel = $request->tag_artikel;
        $artikel->judul = $request->judul;
        $artikel->isi = $request->isi;
        $artikel->status = $request->status;
        $artikel->create_by = Auth::user()->name;
        $artikel->save();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_name = $name . '.' . time() . $extension;
            $path = $file->storeAs('assets/artikel/', $file_name, 'public');
            $artikel->gambar = $path;
            $artikel->save();
        }
    }

    public function hapus($id)
    {
        $artikel = Artikel::findOrFail($id);

        $artikel->delete();

        return redirect()->route('artikel.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('assets/upload-image-artikel', $filename, 'public');

            return response()->json([
                'location' => asset('storage/assets/upload-image-artikel/' . $filename)
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
