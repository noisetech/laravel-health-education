<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::with(['permissions'])->orderBy('name', 'asc')->paginate(5);

        return view('pages.role.index', compact('role'));
    }


    public function tambah()
    {
        $pemrission = Permission::all();
        return view('pages.role.tambah', compact('pemrission'));
    }


    public function simpan(Request $request)
    {
        $this->validate($request, [
            'hak_akses' => 'required',
            'level_pengguna' => 'required|unique:roles,name'
        ], [
            'hak_akses.required' => 'Hak akses tidak boleh kosong',
            'level_pengguna.required' => 'Level pengguna tidak boleh kosong',
            'level.unique' => 'Level pengguna sudah ada'
        ]);

        DB::beginTransaction();
        try {

            $role = new Role();
            $role->name = $request->level_pengguna;
            $role->guard_name = 'web';
            $role->save();

            $role->syncPermissions($request->hak_akses);

            return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('role.index')->with('error', 'Role gagal ditambahkan');
        }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hak_akses' => 'required',
            'level_pengguna' => 'required|unique:roles,name,' . $id
        ], [
            'hak_akses.required' => 'Hak akses tidak boleh kosong',
            'level_pengguna.required' => 'Level pengguna tidak boleh kosong',
            'level.unique' => 'Level pengguna sudah ada'
        ]);

        DB::beginTransaction();
        try {

            $role = Role::findOrFail($id);
            $role->name = $request->level_pengguna;
            $role->guard_name = 'web';
            $role->save();

            $role->syncPermissions($request->hak_akses);

            return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('role.index')->with('error', 'Role gagal diperbarui');
        }
    }


    public function hapus($id){
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
