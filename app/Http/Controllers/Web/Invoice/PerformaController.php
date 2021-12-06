<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Detail;
use App\Models\History;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Ship;
use App\Models\Type;
use App\Models\Warehouse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformaController extends Controller
{
    public function index(Request $request, $id)
    {
        $title = "Invoice";
        //kalau ada request ambil product
        $Product = Product::with(['warehouse', 'type', 'status'])->where('status_id', 1)->where('mark', 'ON');
        if ($request->warehouse) {
            $Product->where('warehouse_id', $request->warehouse);
        }
        if ($request->type) {
            $Product->where('type_id', $request->type);
        }
        $Product = $Product->get();

        //membuat invoice awal
        $Invoice = Invoice::find($id);
        $Detail = Detail::where('transaksi_id', $Invoice->id)->get();
        $Price = 0;
        foreach ($Detail as $Data) {
            $Price = $Price + $Data->price;
        }
        $PPN = $Price + (($Price * 10) / 100);

        $Warehouse = Warehouse::get(['name', 'id']);
        $Type = Type::get(['name', 'id']);
        $Ship = Ship::get(['name', 'id']);
        $Category = Category::get(['name', 'id']);
        $Customer = Customer::get(['name', 'id']);
        $User = User::get(['username', 'id']);
        $Bank = Bank::get(['username', 'id']);

        return view('invoice.editperforma', compact('title', 'Ship', 'Detail', 'Price', 'PPN', 'Warehouse', 'Type', 'Product', 'Invoice', 'Category', 'Customer', 'User','Bank'));
    }

    public function edit(Request $request, $id)
    {
        $Invoice = Invoice::find($id);
        $Invoice->due_date = null;
        $Invoice->status = 'invoice';
        $Invoice->invoice_date = $request->invoice_date;
        $Invoice->type = $request->type;
        $Invoice->deskripsi = $request->deskripsi;
        $Invoice->customer_id = $request->customer_id;
        $Invoice->npwp = $request->npwp;
        $Invoice->address = $request->address;
        $Invoice->ship_id = $request->ship_id;
        $Invoice->transfer_date = $request->transfer_date;
        $Invoice->transfer_name = $request->transfer_name;
        $Invoice->bank = $request->bank;
        $Invoice->contact = $request->contact;

        $Invoice->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate Performa', 'tanggal' => date("d-m-Y")]);

        return redirect(url('reportinvoice'));
    }
}