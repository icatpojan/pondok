<?php

namespace App\Http\Controllers\Web\Master;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function index()
    {
        $Bank = Bank::all();
        $title = "Bank";
        return view('master.bank', compact('title', 'Bank'));
    }

    public function store(Request $request)
    {
        $Bank = Bank::create([
            'name' => $request->name,
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah bank', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $Bank = Bank::where('id', $id)->first();
        $Bank->name = $request->name;
        $Bank->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate bank', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil mengupdate');
        return back();
    }

    public function destroy($id)
    {
        $Bank = Bank::where('id', $id)->first();
        $Bank->delete();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus bank', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }
}