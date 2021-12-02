<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\Product;
use App\Models\Warehouse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->awal || $request->akhir) {
            $Invoice = Invoice::whereBetween('created_at', [$request->awal, $request->akhir])->orderby('created_at', 'DESC')->get();
        }
        if ($request->awal) {
            $Invoice = Invoice::where('created_at', 'LIKE', "$request->awal%")->orderby('created_at', 'DESC')->get();
        }
        if (!$request->awal) {
            $Invoice = Invoice::orderby('created_at', 'DESC')->get();
        }
        $title = "Report";
        return view('pages.invoice.report', compact('title', 'Invoice'));
    }

    public function mutasiindex()
    {
        $Mutasi = Mutasi::with(['warehouse', 'type', 'status'])->get();
        $Warehouse = Warehouse::all();
        $title = "Mutasi";
        return view('product.mutasi', compact('title', 'Mutasi', 'Warehouse'));
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
                'keterangan' => $Product->keterangan,
                'price' => $Product->price,
                'type_id' => $Product->type_id,
                'warehouse_id' => $Product->warehouse_id,
                'status_id' => $Product->status_id,
            ]);
            $Mutasi->save();
            return back();
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Barang sudah di daftar');
            return back();
        }
    }

    public function mutasimass(Request $request)
    {
        $Mutasi = Mutasi::all();
        try {
            foreach ($Mutasi as $Data) {
                $Product = Product::where('sn', $Data->sn)->first();
                $Product->warehouse_id = $request->warehouse_id;
                $Product->update();
                $Data->delete();
            }
            alert()->success('Sukses', 'Berh;asil');
            return back();
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Gagal');
            return back();
        }
    }

    public function cetak_pdf($id)
    {
        $Invoice = Invoice::where('id', $id)->with(['customer', 'ship'])->first();
        $Detail = Detail::where('transaksi_id', $Invoice->id)->with(['product'])->get();
        $pdf = PDF::loadview('pdf', compact('Invoice', 'Detail'))->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function delete($id)
    {
        $Invoice = Invoice::find($id);
        $Detail = Detail::where('transaksi_id', $Invoice->id)->get();
        foreach ($Detail as $value) {
            $Product = Product::where('id', $value->produk_id)->first();
            $Product->status_id = 1;
            $Product->update();
            $value->delete();
        }
        $Invoice->delete();
        alert()->success('Sukses', 'Berhasil menghapus dan mengembalikan status produk');
        return back();
    }
}