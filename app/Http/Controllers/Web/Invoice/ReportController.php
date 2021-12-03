<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Product;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $Invoice = Invoice::where('status', 'invoice')->orderby('created_at', 'DESC');
        if ($request->awal || $request->akhir) {
            $Invoice->whereBetween('created_at', [$request->awal, $request->akhir]);
        }
        if ($request->awal) {
            $Invoice->where('created_at', 'LIKE', "$request->awal%");
        }
        $Invoice = $Invoice->get();
        $title = "Report";
        return view('report.report', compact('title', 'Invoice'));
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