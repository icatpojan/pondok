<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MediaController extends Controller
{
    // Menampilkan daftar semua media
    public function index(Request $request)
    {
        $query = Media::query();
        $medias = $query->orderBy('id', 'DESC')->paginate(10);
        $title = 'Media';
        return view('media.index', compact('medias','title'));
    }


    // Menghapus media dari database
    public function destroy($id)
    {
        $media = Media::where('id',$id)->first();
        $media->delete();
        return redirect()->route('media')->with('success', 'Media deleted successfully.');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('media', 'public');
            $media = Media::create([
                'image' => $filePath,
                'type' => $request->type,
                'deskripsi' => $request->deskripsi
            ]);
        }


        return redirect()->back()->with('success', 'Media added successfully.');
    }

}
