<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
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
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Invoice::max('id');
        if ($noUrutAkhir) {
            $Nomer = sprintf("%04s", abs($noUrutAkhir + 1)) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        } else {
            $Nomer = sprintf("%04s", 1) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        }
        $Customer = Customer::get(['name', 'id']);
        $Ship = Ship::get(['name', 'id']);
        $User = User::get(['username', 'id']);
        $title = 'create invoice';

        return view('invoice.createInvoice', compact('Nomer', 'Customer', 'User', 'Ship', 'title'));
    }

    public function create_performa()
    {
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Invoice::max('id');
        if ($noUrutAkhir) {
            $Nomer = sprintf("%04s", abs($noUrutAkhir + 1)) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        } else {
            $Nomer = sprintf("%04s", 1) . '-INV-PIM-' . 'VMS' . '-' . $bulanRomawi[date('n')] . '-' . date('Y');
        }
        return view('invoice.createPerforma', compact('Nomer'));
    }

    public function invoiceInfoStore(Request $request)
    {
        $Transaksi = Invoice::create([
            'invoice_no' => $request->invoice_no,
            'invoice_date' => $request->invoice_date,
            'deskripsi' => $request->description,
            'type' => $request->type,
        ]);

        return redirect(url('/customerinfo'));
    }

    public function customerInfo()
    {
        $title = 'Customer Info';
        $Customer = Customer::get(['name', 'id']);
        return view('invoice.plot.customerInfo', compact('title', 'Customer'));
    }

    public function customerInfostore(Request $request)
    {
        $Transaksi = Invoice::where('mark', null)->first();
        $Transaksi->customer_id = $request->customer_id;
        $Transaksi->npwp = $request->npwp;
        $Transaksi->address = $request->address;
        $Transaksi->update();
        return redirect(url('/transferinfo'));
    }

    public function transferInfo()
    {
        $title = 'Transfer Info';
        $Customer = Customer::get(['name', 'id']);
        return view('invoice.plot.transferInfo', compact('title', 'Customer'));
    }

    public function airtimeInfo()
    {
        $title = 'Transfer Info';
        $Ship = Ship::get(['name', 'id']);
        return view('invoice.plot.airtimeInfo', compact('title', 'Ship'));
    }

    public function userInfo()
    {
        $title = 'User Info';
        $User = User::get(['username', 'id']);
        $Detail = Detail::where('transaksi_id', null)->get();
        return view('invoice.plot.userInfo', compact('title', 'User'));
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
