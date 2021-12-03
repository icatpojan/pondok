<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Product;
use App\Models\Status;
use App\Models\Type;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $Product = Product::with(['warehouse', 'type', 'status'])->where('tgl_delete', '=', null)->orderBy('created_at', 'DESC')->get();
        $Type = Type::get(['name', 'id']);
        $Warehouse = Warehouse::get(['name', 'id']);
        $Status = Status::get(['name', 'id']);
        $title = "Product";
        return view('product.product', compact('title', 'Product', 'Type', 'Warehouse', 'Status'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $Product = Product::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Products Deleted successfully."]);
    }

    public function search(Request $request)
    {
        $Product = Product::with(['warehouse', 'type', 'status']);
        if ($request->warehouse) {
            $Product->where('warehouse_id', $request->warehouse);
        }
        if ($request->status) {
            $Product->where('status_id', $request->status);
        }
        if ($request->type) {
            $Product->where('type_id', $request->type);
        }
        $Product = $Product->get();
        $Type = Type::get(['name', 'id']);
        $Warehouse = Warehouse::get(['name', 'id']);
        $Status = Status::get(['name', 'id']);
        $title = "Product";
        return view('product.product', compact('title', 'Product', 'Type', 'Warehouse', 'Status'));
    }

    public function store(Request $request)
    {
        $Product = Product::create([
            'sn' => $request->sn,
            'product_id' => $request->product_id,
            'imei' => $request->imei,
            'keterangan' => $request->keterangan,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'tgl_masuk' => $request->tgl_masuk,
            'entri_user_masuk' => Auth::id(),
            'warehouse_id' => $request->warehouse_id,
            'status_id' => $request->status_id,
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah Produk', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $Product = Product::where('id', $id)->first();
        $Product->sn = $request->sn;
        $Product->product_id = $request->product_id;
        $Product->imei = $request->imei;
        $Product->keterangan = $request->keterangan;
        $Product->price = $request->price;
        $Product->tgl_masuk = $Product->tgl_masuk;
        $Product->type_id = $request->type_id;
        $Product->warehouse_id = $request->warehouse_id;
        $Product->status_id = $request->status_id;
        $Product->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate Produk', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil mengupdate');
        return back();
    }

    public function destroy($id)
    {
        $Produk = Product::where('id', $id)->first();
        try {
            $Produk->update([
                'tgl_delete' => date("Y-m-d"),
                'user_delete' => Auth::id(),
            ]);
            History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus produk', 'tanggal' => date("d-m-Y")]);
            alert()->success('Sukses', 'Berhasil menghapus');
            return back();
        } catch (\Exception $e) {
            alert()->error('error', 'gagal');
            return back();
        }
    }
}