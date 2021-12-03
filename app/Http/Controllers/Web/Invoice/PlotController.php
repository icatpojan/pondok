<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Detail;
use App\Models\Invoice;
use App\Models\Ship;
use App\User;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function create_invoice()
    {
        $Invoice = Invoice::where('mark', null)->first();
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Invoice::max('id');
        if ($noUrutAkhir) {
            $Nomer = sprintf("%04s", abs($noUrutAkhir + 1)) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        } else {
            $Nomer = sprintf("%04s", 1) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        }
        if (!$Invoice) {
            $Invoice = Invoice::create([
                'invoice_no' => $Nomer,
                'status' => 'invoice',
            ]);
        } else {
            $Invoice->status = 'invoice';
            $Invoice->update();
        }
        $Customer = Customer::get(['name', 'id']);
        $Ship = Ship::get(['name', 'id']);
        $User = User::get(['username', 'id']);
        $Category = Category::get(['name']);
        $title = 'create invoice';

        return view('invoice.createInvoice', compact('Invoice', 'Category', 'Customer', 'User', 'Ship', 'title'));
    }

    public function create_performa()
    {
        $Invoice = Invoice::where('mark', null)->first();
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Invoice::max('id');
        if ($noUrutAkhir) {
            $Nomer = sprintf("%04s", abs($noUrutAkhir + 1)) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        } else {
            $Nomer = sprintf("%04s", 1) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        }
        if (!$Invoice) {
            $Invoice = Invoice::create([
                'invoice_no' => $Nomer,
            ]);
        } else {
            $Invoice->status = 'performa';
            $Invoice->update();
        }
        $Customer = Customer::get(['name', 'id']);
        $Ship = Ship::get(['name', 'id']);
        $User = User::get(['username', 'id']);
        $Category = Category::get(['name']);
        $title = 'create invoice';

        return view('invoice.createInvoice', compact('Invoice', 'Category', 'Customer', 'User', 'Ship', 'title'));
    }

    public function invoiceInfoStore(Request $request)
    {
        $Invoice = Invoice::where('mark', null)->first();
        $Invoice->invoice_no = $request->invoice_no;
        $Invoice->invoice_date = $request->invoice_date;
        $Invoice->deskripsi = $request->deskripsi;
        $Invoice->type = $request->type;
        $Invoice->category = $request->category;
        $Invoice->update();

        return redirect(url('/customerinfo'));
    }

    public function customerInfo()
    {
        $title = 'Customer Info';
        $Customer = Customer::get(['name', 'id']);
        $Invoice = Invoice::where('mark', null)->first();
        return view('invoice.plot.customerInfo', compact('title', 'Customer', 'Invoice'));
    }

    public function customerInfostore(Request $request)
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Transaksi->customer_id = $request->customer_id;
        $Transaksi->npwp = $request->npwp;
        $Transaksi->address = $request->address;
        $Transaksi->update();
        if ($Transaksi->status == 'performa') {
            return redirect(url('/userinfo'));
        }
        return redirect(url('/transferinfo'));
    }

    public function transferInfo()
    {
        $title = 'Transfer Info';
        $Customer = Customer::get(['name', 'id']);
        $Invoice = Invoice::where('mark', null)->first();
        return view('invoice.plot.transferInfo', compact('title', 'Customer', 'Invoice'));
    }

    public function airtimeInfo()
    {
        $title = 'Transfer Info';
        $Ship = Ship::get(['name', 'id']);
        $Invoice = Invoice::where('mark', null)->first();
        return view('invoice.plot.airtimeInfo', compact('title', 'Ship','Invoice'));
    }

    public function userInfo()
    {
        $title = 'User Info';
        $User = User::get(['username', 'id']);
        $Invoice = Invoice::where('mark', null)->first();
        $Detail = Detail::where('transaksi_id', null)->with(['type', 'warehouse', 'status'])->get();
        $Price = 0;
        foreach ($Detail as $Data) {
            $Price = $Price + $Data->price;
        }

        $Invoice->total_harga = $Price;

        if ($Invoice->persen == 'rupiah') {
            $Invoice->harga_akhir = $Price - $Invoice->discount;
        }

        if ($Invoice->persen == 'persen') {
            $Invoice->harga_akhir = $Price - $Price * $Invoice->discount / 100;
        }
        $Invoice->update();
        $PPN = $Price + (($Price * 10) / 100);
        return view('invoice.plot.userInfo', compact('title', 'User', 'Price', 'Detail', 'PPN', 'Invoice'));
    }

    public function transferInfostore(Request $request)
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Transaksi->transfer_date = $request->transfer_date;
        $Transaksi->transfer_name = $request->transfer_name;
        $Transaksi->bank = $request->bank;
        $Transaksi->contact = $request->contact;
        $Transaksi->update();
        if ($Transaksi->type == 'AIRTIME' || $Transaksi->type == 'VMS dan AIRTIME') {
            return redirect(url('/airtimeinfo'));
        }
        return redirect(url('/userinfo'));
    }

    public function airtimeInfoStore(Request $request)
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Transaksi->ship_id = $request->ship_id;
        $Transaksi->transmiter_id = $request->transmiter_id;
        $Transaksi->airtime_price = $request->airtime_price;
        $Transaksi->airtime_id = $request->airtime_id;
        $Transaksi->airtime_start = $request->airtime_start;
        $Transaksi->update();

        return redirect(url('/userinfo'));
    }
}