<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Ship;
use App\Models\Type;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $Product = Product::with(['warehouse', 'type', 'status'])->where('status_id', 1);
        if ($request->warehouse) {
            $Product->where('warehouse_id', $request->warehouse);
        }
        if ($request->type) {
            $Product->where('type_id', $request->type);
        }
        $Product = $Product->get();
        $title = "Invoice";
        $Detail = Detail::where('transaksi_id', null)->with(['type', 'warehouse', 'status'])->get();
        $Price = 0;
        foreach ($Detail as $Data) {
            $Price = $Price + $Data->price;
        }
        $PPN = $Price + (($Price * 10) / 100);
        $Warehouse = Warehouse::get(['name', 'id']);
        $Type = Type::get(['name', 'id']);
        $Ship = Ship::get(['name', 'id']);
        return view('invoice.invoice', compact('title', 'Ship', 'Detail', 'Price', 'PPN', 'Warehouse', 'Type', 'Product'));
    }
    public function add(Request $request)
    {
        $cek = Detail::where('sn', $request->sn)->first();
        if ($cek) {
            alert()->error('Ingat', 'Produk sudah ditambahkan ');
            return back();
        }
        try {
            $Produk = Product::where('sn', $request->sn)->first();
            if ($Produk->status_id == 2) {
                alert()->error('Ingat', 'Produk sudah terjual');
                return back();
            }
            $Detail = Detail::create([
                'sn' => $Produk->sn,
                'produk_id' => $Produk->id,
                'imei' => $Produk->imei,
                'type_id' => $Produk->type_id,
                'warehouse_id' => $Produk->warehouse_id,
                'status_id' => $Produk->status_id,
                'price' => $Produk->type->price,
            ]);
            $Detail->save();
            return back();
        } catch (\Exception $e) {
            return $e;
            alert()->error('Gagal', 'Produk tidak ada ');
            return back();
        }
    }

    public function destroy($id)
    {
        $Detail = Detail::where('id', $id)->first();
        $Detail->delete();
        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }

    public function updateprice(Request $request, $id)
    {
        $Detail = Detail::where('id', $id)->first();
        $Detail->price = $request->price;
        $Detail->update();
        return redirect(url('userinfo'));
    }

    public function updatediscount(Request $request)
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Transaksi->discount = $request->discount;
        $Transaksi->persen = $request->persen;
        $Transaksi->update();
        return redirect(url('userinfo'));
    }

    public function updatesign(Request $request)
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Transaksi->user_id = $request->user_id;
        $Transaksi->update();
        return redirect(url('userinfo'));
    }

    public function checkout()
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Detail = Detail::where('transaksi_id', null)->get();
        if ($Detail == []) {
            alert()->error('Gagal', 'Silakan pilih barang terlebih dahulu');
            return back();
        }
        $Transaksi->mark = 'end';
        $Transaksi->update();
        foreach ($Detail as  $value) {
            $Product = Product::find($value->produk_id);
            $value->transaksi_id = $Transaksi->id;
            $value->status_id = 2;
            $Product->status_id = 2;
            $value->update();
            $Product->update();
        }
        return redirect(url('invoice'));
    }

    public function checkoutperforma()
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Detail = Detail::where('transaksi_id', null)->get();
        if ($Detail == []) {
            alert()->error('Gagal', 'Silakan pilih barang terlebih dahulu');
            return back();
        }
        $Transaksi->mark = 'end';
        $Transaksi->update();
        foreach ($Detail as  $value) {
            $Product = Product::find($value->produk_id);
            $value->transaksi_id = $Transaksi->id;
            $value->status_id = 2;
            $Product->status_id = 3;
            $value->update();
            $Product->update();
        }
        return redirect(url('invoice'));
    }

    public function stempel(Request $request)
    {
        $AWAL = $request->get('id');
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Invoice::max('id');
        $no = 1;
        if ($noUrutAkhir) {
            $Nomer = sprintf("%04s", abs($noUrutAkhir + 1)) . '-INV-PIM-' . $AWAL . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
            return $this->sendResponse('Success', 'ini dia daftar nomernya bos', $Nomer, 200);
        } else {
            $Nomer = sprintf("%04s", $no) . '-INV-PIM-' . $AWAL . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
            return $this->sendResponse('Success', 'ini dia daftar nomernya bos', $Nomer, 200);
        }
    }
}
