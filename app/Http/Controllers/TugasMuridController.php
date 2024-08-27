<?php

namespace App\Http\Controllers;

use App\MapelKelas;
use App\TugasGuru;
use App\TugasMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasMuridController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $mapelkelass = MapelKelas::with(['mapel', 'kelas', 'user'])->get();
        } else {
            $mapelkelass = MapelKelas::with(['mapel', 'kelas', 'user'])
            ->where('kelas_id', Auth::user()->kelas_id)
                ->get();

            foreach ($mapelkelass as $mapelkelas) {
                // Cek apakah ada tugas yang belum dikerjakan oleh murid
                $mapelkelas->status = TugasGuru::where('mapel_kelas_id', $mapelkelas->id)
                    ->whereDoesntHave('tugasmurid', function ($query) {
                        $query->where('murid_id', Auth::user()->id);
                    })
                    ->exists();
            }
        }

        $title = 'tugas murid';
        return view('tugasmurid.index', compact('title', 'mapelkelass'));
    }


    public function show($id)
    {
        $tugasguru = TugasGuru::orderBy('id', 'DESC')->where('mapel_kelas_id', $id)->get();
        foreach ($tugasguru as $key => $value) {
            $value->status = TugasMurid::where('tugas_id', $value->id)
                ->where('murid_id', Auth::user()->id)
                ->exists();
            $value->tugas = TugasMurid::where('tugas_id', $value->id)
                ->where('murid_id', Auth::user()->id)
                ->first();
        }
        $title = 'tugasmurid';
        return view('tugasmurid.show', compact('tugasguru', 'title'));
    }

    public function store(Request $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugasguru', 'public');
        }

        TugasMurid::create([
            'name' => $request->name,
            'tugas_id' => $request->tugas_id,
            'murid_id' => Auth::user()->id,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'TugasGuru berhasil ditambahkan.');
    }
}
