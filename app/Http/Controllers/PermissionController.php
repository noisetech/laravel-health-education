<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('pages.permission.index', compact('permissions'));
    }

    public function tambah()
    {
        return view('pages.permission.tambah');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'hak_akses' => 'required'
        ], [
            'hak_akses.required' => 'Hak akses tidak boleh kosong'
        ]);

        $permission = new Permission();
        $permission->name = $request->hak_akses;
        $permission->guard_name = 'web';
        $permission->save();

        return redirect()->route('permissions')->with('status', 'Hak akses berhasil ditambahkan');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('pages.permission.edit', compact('permission'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hak_akses' => 'required'
        ], [
            'hak_akses.required' => 'Hak akses tidak boleh kosong'
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->hak_akses;
        $permission->guard_name = 'web';
        $permission->save();

        return redirect()->route('permissions')->with('status', 'Hak akses berhasil diupdate');
    }


    public function hapus($id)
    {

        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions')->with('status', 'Hak akses berhasil dihapus');
    }
}
