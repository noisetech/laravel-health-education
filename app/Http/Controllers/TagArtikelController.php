<?php

namespace App\Http\Controllers;

use App\Models\TagArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagArtikelController extends Controller
{
    public function index()
    {
        $tag_artikel = TagArtikel::orderBy('tag', 'asc')->paginate(5);

        return view('pages.tag-artikel.index', compact('tag_artikel'));
    }

    public function tambah()
    {
        return view('pages.tag-artikel.tambah');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'tag' => 'required'
        ], [
            'tag.required' => 'tag tidak boleh kosong'
        ]);


        $tag_artikel = new TagArtikel();
        $tag_artikel->tag = $request->tag;
        $tag_artikel->slug = Str::slug($request->tag);
        $tag_artikel->save();

        return redirect()->route('tag-artikel')->with('status', 'Tag artikel berhasil ditambahkan');
    }


    public function edit($id)
    {
        $tag_artikel = TagArtikel::findOrFail($id);

        return view('pages.tag-artikel.edit', compact('tag_artikel'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tag' => 'required'
        ], [
            'tag.required' => 'tag tidak boleh kosong'
        ]);


        $tag_artikel = TagArtikel::findOrFail($id);
        $tag_artikel->tag = $request->tag;
        $tag_artikel->slug = Str::slug($request->tag);
        $tag_artikel->save();

        return redirect()->route('tag-artikel')->with('status', 'Tag artikel berhasil diubah');
    }

    public function hapus($id)
    {

        $tag_artikel = TagArtikel::findOrFail($id);

        $tag_artikel->delete();

        return redirect()->route('tag-artikel')->with('status', 'Tag artikel berhasil dihapus');
    }
}
