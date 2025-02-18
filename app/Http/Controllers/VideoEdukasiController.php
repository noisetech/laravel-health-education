<?php

namespace App\Http\Controllers;

use App\Models\VideoEdukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoEdukasiController extends Controller
{
    public function index()
    {
        $video_edukasi = VideoEdukasi::latest()->paginate(10);

        return view('pages.video-edukasi.index', [
            'video_edukasi' => $video_edukasi
        ]);
    }

    public function tambah()
    {
        return view('pages.video-edukasi.tambah');
    }


    public function simpan(Request $request)
    {
        $this->validate($request, [
            'url' => 'required'
        ], [
            'url.required' => 'url tidak boleh kosong'
        ]);

        $video_edukasi = new VideoEdukasi();
        $video_edukasi->url = $request->url;
        $video_edukasi->status = 'publish';
        $video_edukasi->create_by = Auth::user()->name;
        $video_edukasi->update_by = Auth::user()->name;
        $video_edukasi->save();

        return redirect()->route('video_edukasi')->with('status', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $video_edukasi = VideoEdukasi::findOrFail($id);

        return view('pages.video-edukasi.edit', [
            'video_edukasi' => $video_edukasi
        ]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required'
        ]);

        $video_edukasi = VideoEdukasi::find($id);
        $video_edukasi->status = $request->status;
        $video_edukasi->create_by = Auth::user()->name;
        $video_edukasi->update_by = Auth::user()->name;

        $video_edukasi->url = $request->url;
        $video_edukasi->save();
        // dd($video_edukasi);



        return redirect()->route('video_edukasi')->with('status', 'Data berhasil diubah');
    }


    public function hapus($id)
    {
        $video_edukasi = VideoEdukasi::findOrFail($id);

        $video_edukasi->delete();

        return redirect()->route('video_edukasi')->with('status', 'Data berhasil dihapus');
    }
}
