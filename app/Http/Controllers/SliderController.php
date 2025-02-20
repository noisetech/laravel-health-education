<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();

        return view('pages.slider.index', [
            'slider' => $slider
        ]);
    }

    public function tambah()
    {
        return view('pages.slider.tambah');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'main_text' => 'required',
            'second_text' => 'required',
            'image' => 'required|image|mimes:png,jpg|max:2048',
        ]);

        if ($request->hasFile('file_pendukung')) {
            $file = $request->file('file_pendukung');
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $finalName = $fileName . '_' . time() . '.' . $extension;

            $path = $file->storeAs('assets/file-pendukung-arsip-akreditasi', $finalName, 'public');
            $file_path = $path;
        }


        $slider = new Slider();
        $slider->main_text = $request->main_text;
        $slider->second_text = $request->second_text;
        $slider->image = $file_path;
        $slider->save();

        return redirect()->route('slider')->with('status', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('pages.slider.edit', [
            'slider' => $slider
        ]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'main_text' => 'required',
            'second_text' => 'required',
            'image' => 'required|image|mimes:png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $slider = Slider::find($id);
            $slider->main_text = $request->main_text;
            $slider->second_text = $request->second_text;
            $slider->save();

            if ($request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $finalName = $fileName . '_' . time() . '.' . $extension;

                $path = $file->storeAs('assets/file-pendukung-arsip-akreditasi', $finalName, 'public');
                $file_path = $path;
                $slider->image = $file_path;

                $slider->save();
            }
            return redirect()->route('slider')->with('status', 'Data berhasil diubah');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    public function hapus($id)
    {
        $slider = Slider::find($id);

        $slider->delete();

        return redirect()->route('slider')->with('status', 'Data berhasil dihapus');
    }
}
