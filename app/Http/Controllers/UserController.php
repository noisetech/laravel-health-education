<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles'])->orderBy('name', 'asc')->paginate(5);

        return view('pages.users.index', compact('users'));
    }

    public function tambah()
    {
        return view('pages.user.tambah');
    }


    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        DB::beginTransaction();

        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->assignRole($request->role);

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan cek inputan anda');
        }
    }


    public function edit($id)
    {
        $users = User::findOrFail($id);

        $role = Role::all();

        return view('pages.user.edit', compact('users', 'role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:8'
        ]);

        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->assignRole($request->role);

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan cek inputan anda');
        }
    }


    public function hapus($id){
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
