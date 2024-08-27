<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\MapelKelas;
use App\User;
use Illuminate\Http\Request;

class MapelKelasController extends Controller
{
    public function index(Request $request)
    {
        $query = MapelKelas::query();

        if ($request->filled('kelas')) {
            $query->where('kelas_id', $request->kelas);
        }

        if ($request->filled('user')) {
            $query->where('guru_id', $request->user);
        }

        if ($request->filled('mapel')) {
            $query->where('mapel_id', $request->mapel);
        }

        $mapelkelas = $query->orderBy('id', 'DESC')->with(['mapel', 'kelas', 'user'])->paginate(10);

        // $mapelkelas = MapelKelas::orderBy('id','DESC')->with(['mapel', 'kelas', 'user'])->paginate(10);
        $mapels = Mapel::all();
        $kelass = Kelas::all();
        $users = User::role('guru')->get();
        $title = 'mapelkelas';
        return view('mapelkelas.index', compact('mapelkelas', 'title', 'mapels', 'kelass', 'users'));
    }

    public function store(Request $request)
    {

        MapelKelas::create([
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()->route('mapelkelas')->with('success', 'MapelKelas created successfully.');
    }

    public function update(Request $request, $id)
    {
        $mapelkelas = MapelKelas::findOrFail($id);


        $mapelkelas->update([
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()->route('mapelkelas')->with('success', 'MapelKelas updated successfully.');
    }

    public function destroy($id)
    {
        $mapelkelas = MapelKelas::findOrFail($id);
        $mapelkelas->delete();

        return redirect()->route('mapelkelas')->with('success', 'MapelKelas deleted successfully.');
    }
}
