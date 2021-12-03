<?php

namespace App\Http\Controllers\web\Product;

use App\Http\Controllers\Controller;
use App\Models\Mutasi;
use App\Models\Product;
use App\Models\Status;
use App\Models\Type;
use App\Models\Warehouse;
use App\User;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function mutasiindex(Request $request)
    {
        $Product = Product::with(['warehouse', 'type', 'status'])->where('tgl_delete', '=', null)->orderBy('created_at', 'DESC');
        if ($request->warehouse) {
            $Product->where('warehouse_id', $request->warehouse);
        }
        if ($request->type) {
            $Product->where('type_id', $request->type);
        }
        if ($request->status) {
            $Product->where('status_id', $request->status);
        }
        $Product = $Product->get();
        $Mutasi = Mutasi::with(['warehouse_f', 'type', 'status'])->where('mark', 1)->get();
        $Warehouse = Warehouse::all();
        $Status = Status::get(['name', 'id']);
        $Type = Type::get(['name', 'id']);
        $User = User::get(['username', 'id']);
        $title = "Mutasi";
        return view('product.mutasi', compact('title', 'Mutasi', 'Warehouse', 'Product', 'Status', 'Type','User'));
    }

    public function history()
    {
        $Mutasi = Mutasi::where('mark', 2)->get();
        $title = "History Mutasi";
        return view('product.mutasihistory', compact('title', 'Mutasi'));
    }

    public function mutasidestroy($sn)
    {
        $Mutasi = Mutasi::where('sn', $sn)->first();
        $Mutasi->delete();
        return back();
    }

    public function mutasiadd(Request $request)
    {
        $Product = Product::where('sn', $request->sn)->first();
        if (!$Product) {
            alert()->error('Gagal', 'Barang tidak ada');
            return back();
        }
        try {
            $Mutasi = Mutasi::create([
                'sn' => $Product->sn,
                'imei' => $Product->imei,
                'type_id' => $Product->type_id,
                'warehouse_from' => $Product->warehouse_id,
                'status_id' => $Product->status_id,
            ]);
            $Mutasi->save();
            return back();
        } catch (\Exception $e) {
            return $e;
            alert()->error('Gagal', 'Barang sudah di daftar');
            return back();
        }
    }

    public function mutasimass(Request $request)
    {
        $Mutasi = Mutasi::where('mark', 1)->get();
        try {
            foreach ($Mutasi as $Data) {
                $Product = Product::where('sn', $Data->sn)->first();
                $Product->warehouse_id = $request->warehouse_id;
                $Product->update();
                $Data->warehouse_to = $request->warehouse_id;
                $Data->mark = 2;
                $Data->user_id = $request->user_id;
                $Data->reason = $request->reason;
                $Data->date = $request->date;
                $Data->update();
            }
            alert()->success('Sukses', 'Berhasil memutasi barang');
            return back();
        } catch (\Exception $e) {
            alert()->error('Gagal', 'sedang ada masalah');
            return back();
        }
    }
}