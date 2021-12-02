<?php

namespace App\Http\Controllers\web\Product;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index()
    {
        $Status = Status::all();
        $title = "Status";
        return view('product.status', compact('title', 'Status'));
    }

    public function store(Request $request)
    {
        $Status = Status::create([
            'name' => $request->name,
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah Status', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menambah');

        return back();
    }

    public function update(Request $request, $id)
    {
        $Status = Status::where('id', $id)->first();
        $Status->name = $request->name;
        $Status->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate status', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil mengupdate');

        return back();
    }

    public function destroy($id)
    {
        $Status = Status::where('id', $id)->first();
        $Status->delete();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghaapus status', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }
}