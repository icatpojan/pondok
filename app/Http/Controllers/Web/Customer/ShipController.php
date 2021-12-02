<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\History;
use App\Models\Ship;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipController extends Controller
{
    public function index()
    {
        $Ship = Ship::get();
        $Customer = Customer::all();
        $title = "Ship";
        return view('customer.ship', compact('title', 'Ship', 'Customer'));
    }

    public function store(Request $request)
    {
        $Ship = Ship::create([
            'name' => $request->name,
            'customer_id' => $request->customer_id,
            'sn' => $request->sn,
            'imei' => $request->imei,
            'type' => $request->type,
            'deskripsi' => $request->deskripsi,
            'airtime_start' => $request->airtime_start,
            'airtime_end' => date('Y-m-d', strtotime('+365 days', strtotime($request->airtime_start))),
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah Kapal', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $Ship = Ship::where('id', $id)->first();
        $Ship->name = $request->name;
        $Ship->customer_id = $request->customer_id;
        $Ship->sn = $request->sn;
        $Ship->imei = $request->imei;
        $Ship->type = $request->type;
        $Ship->deskripsi = $request->deskripsi;
        $Ship->airtime_start = $request->airtime_start;
        $Ship->airtime_end = $request->airtime_end;
        $Ship->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate Kapal', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil mengupdate');
        return back();
    }

    public function destroy($id)
    {
        $Ship = Ship::where('id', $id)->first();
        $Ship->delete();
        alert()->success('Sukses', 'Berhasil menghapus');
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus Kapal', 'tanggal' => date("d-m-Y")]);

        return back();
    }

    public function show(Request $request)
    {
        if ($request->id) {
            $Ship = Ship::where('id', $request->id)->first();
        }
        if ($request->name) {
            $Ship = Ship::where('name', $request->name)->first();
        }
        return $this->sendResponse('Success', 'ini dia daftar nomernya bos', $Ship, 200);
    }
}