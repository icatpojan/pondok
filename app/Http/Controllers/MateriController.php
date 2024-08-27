<?php

namespace App\Http\Controllers;

use App\MapelKelas;
use App\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->filled('mapelkelas')) {
            $query->where('mapel_kelas_id', $request->mapelkelas);
        }


        // $materi = Materi::orderBy('id', 'DESC')->with(['mapelkelas.kelas', 'mapelkelas.mapel'])->paginate(10);
        if (auth()->user()->hasRole('admin')) {
            $materi = $query->orderBy('id', 'DESC')->with(['mapelkelas.kelas', 'mapelkelas.mapel'])->paginate(10);
            $mapelkelass = MapelKelas::with(['mapel', 'kelas', 'user'])->get();
        } else {
            $materi = $query->orderBy('id', 'DESC')
            ->with(['mapelkelas.kelas', 'mapelkelas.mapel'])
            ->whereHas('mapelkelas', function ($q) {
                $q->where('guru_id', auth()->user()->id);
            })
            ->paginate(10);
            $mapelkelass = MapelKelas::where('guru_id', auth()->user()->id)->with(['mapel', 'kelas', 'user'])->get();
        }
        $title = 'materi';
        return view('materi.index', compact('materi', 'title', 'mapelkelass'));
    }


    public function store(Request $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi', 'public');
        }

        Materi::create([
            'name' => $request->name,
            'mapel_kelas_id' => $request->mapel_kelas_id,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan.');
    }

    // Fungsi untuk mengupdate materi
    public function update(Request $request, Materi $materi)
    {
        $filePath = $materi->file;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('materi', 'public');
        }

        $materi->update([
            'name' => $request->name,
            'mapel_kelas_id' => $request->mapel_kelas_id,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Materi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('materi')->with('success', 'Materi deleted successfully.');
    }
}
