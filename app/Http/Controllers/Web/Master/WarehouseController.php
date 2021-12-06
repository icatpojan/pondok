<?php

namespace App\Http\Controllers\Web\Master;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Province;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index()
    {
        $Warehouse = Warehouse::with(['province'])->get();
        $Province = Province::orderBy('province_name','ASC')->get(['province_name', 'province_id']);
        $title = "Warehouse";
        return view('master.warehouse', compact('title', 'Warehouse', 'Province'));
    }

    public function store(Request $request)
    {
        $WareWarehouse = Warehouse::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
            'category' => $request->category,
            'email' => $request->email,
            'area' => $request->area,
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah Gudang', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $Warehouse = Warehouse::where('id', $id)->first();
        $Warehouse->name = $request->name;
        $Warehouse->address = $request->address;
        $Warehouse->contact = $request->contact;
        $Warehouse->email = $request->email;
        $Warehouse->area = $request->area;
        $Warehouse->category = $request->category;
        $Warehouse->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'mengupdate Gudang', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil mengupdate');

        return back();
    }

    public function destroy($id)
    {
        $WareWarehouse = Warehouse::where('id', $id)->first();
        $WareWarehouse->delete();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus Gudang', 'tanggal' => date("d-m-Y")]);
        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }
}