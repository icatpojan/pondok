<?php

namespace App\Http\Controllers\web\Master;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $User = User::all();
        $Role = Role::all();
        $title = "Configurasi User";
        return view('master.user', compact('title', 'User','Role'));
    }

    public function store(Request $request)
    {
        $User = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $User->assignRole($request->role);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah user', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $User = User::where('id', $id)->first();
        $User->username = $request->username;
        $User->email = $request->email;

        $User->syncRoles($request->role);
        $User->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate user', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil mengupdate');
        return back();
    }

    public function change(Request $request)
    {
        $User = User::find(Auth::id());
        if (!Hash::check($request->password, $User->password)) {
            alert()->error('Gagal', 'Password lama anda salah');
            return back();
        }
        if ($request->new_password != $request->confirmation) {
            alert()->error('Gagal', 'konfirmasi Password anda salah');
            return back();
        }

        $User->password = bcrypt($request->new_password);
        $User->update;
        History::create(['user_id' => Auth::id(), 'keterangan' => 'mengganti Password', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil mengganti password');
        return back();
    }

    public function destroy($id)
    {
        $User = User::where('id', $id)->first();
        if ($id == Auth::id()) {
            alert()->error('Gagal', 'tidak bisa hapus diri sendiri');
            return back();
        }
        $User->delete();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus user', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }
}