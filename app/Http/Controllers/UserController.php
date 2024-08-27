<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Menampilkan daftar semua user
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->where('kelas_id', $request->kelas);
        }

        // Pencarian berdasarkan username atau name
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->with(['roles', 'kelasnya'])->orderBy('id', 'DESC')->paginate(10);
        $roles = Role::all();
        $kelas = Kelas::all();
        $title = 'User';
        return view('users.index', compact('users','title','roles','kelas'));
    }

    public function change(Request $request)
    {

        $User = User::find(Auth::id());
        if (!Hash::check($request->password, $User->password)) {
            alert()->error('Error', 'Old Password is Wrong');
            return back();
        }
        if ($request->new_password != $request->confirmation) {
            alert()->success('Error', 'Password Confirmation Is Wrong');
            return back();
        }

        $User->password = bcrypt($request->new_password);
        $User->update();
        alert()->success('Success', 'Password is changed');
        return back();
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $user = User::create([
            'username' => $request['username'],
            'kelas_id' => $request['kelas'],
            'password' => bcrypt($request['password']),
        ]);

        // Mendaftarkan role ke user
        $user->assignRole($request['role']);

        return redirect()->route('user')->with('success', 'User created successfully.');
    }



    // Memperbarui user di database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->username = $request['username'];
        $user->kelas_id = $request['kelas'];

        if ($request['password']) {
            $user->password = bcrypt($request['password']);
        }

        $user->save();

        // Hapus semua role lama
        $user->roles()->detach();

        // Assign role baru
        $user->assignRole($request['role']);

        return redirect()->route('user')->with('success', 'User updated successfully.');
    }


    // Menghapus user dari database
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        $user->delete();
        return redirect()->route('user')->with('success', 'User deleted successfully.');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->username = $request->username;

        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('profile_photos', 'public');
            $user->image = $filePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}
