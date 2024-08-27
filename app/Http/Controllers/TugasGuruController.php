<?php

namespace App\Http\Controllers;

use App\MapelKelas;
use App\TugasGuru;
use Illuminate\Http\Request;

class TugasGuruController extends Controller
{
    public function index(Request $request)
    {
        $query = TugasGuru::query();

        if ($request->filled('mapelkelas')) {
            $query->where('mapel_kelas_id', $request->mapelkelas);
        }


        // $tugasguru = TugasGuru::orderBy('id', 'DESC')->with(['mapelkelas.kelas', 'mapelkelas.mapel'])->paginate(10);
        if (auth()->user()->hasRole('admin')) {
            $tugasguru = $query->orderBy('id', 'DESC')->with(['mapelkelas.kelas', 'mapelkelas.mapel'])->paginate(10);
            $mapelkelass = MapelKelas::with(['mapel', 'kelas', 'user'])->get();
        } else {
            $tugasguru = $query->orderBy('id', 'DESC')
                ->with(['mapelkelas.kelas', 'mapelkelas.mapel'])
                ->whereHas('mapelkelas', function ($q) {
                    $q->where('guru_id', auth()->user()->id);
                })
                ->paginate(10);
            $mapelkelass = MapelKelas::where('guru_id', auth()->user()->id)->with(['mapel', 'kelas', 'user'])->get();
        }
        $title = 'tugas';
        return view('tugasguru.index', compact('tugasguru', 'title', 'mapelkelass'));
    }


    public function store(Request $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugasguru', 'public');
        }

        TugasGuru::create([
            'name' => $request->name,
            'batas_waktu' => $request->batas_waktu,
            'mapel_kelas_id' => $request->mapel_kelas_id,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'TugasGuru berhasil ditambahkan.');
    }

    // Fungsi untuk mengupdate tugasguru
    public function update(Request $request, TugasGuru $tugasguru)
    {
        $filePath = $tugasguru->file;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('tugasguru', 'public');
        }

        $tugasguru->update([
            'name' => $request->name,
            'batas_waktu' => $request->batas_waktu,
            'mapel_kelas_id' => $request->mapel_kelas_id,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'TugasGuru berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tugasguru = TugasGuru::findOrFail($id);
        $tugasguru->delete();

        return redirect()->route('tugasguru')->with('success', 'TugasGuru deleted successfully.');
    }
}
