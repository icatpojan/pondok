<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashController extends Controller
{
    public function index()
    {
        $Product = Product::with(['status','warehouse','type'])->where('tgl_delete', '!=', null)->orderBy('tgl_masuk', 'ASC')->get();
        $title = "Trash";
        return view('product.trash', compact('title', 'Product'));
    }

    public function restore($id)
    {
        $Produk = Product::where('id', $id)->first();
        try {
            $Produk->update([
                'tgl_delete' => null,
                'user_delete' => null,
            ]);
            History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengembalikan produk', 'tanggal' => date("d-m-Y")]);
            alert()->success('Sukses', 'Berhasil merestore');
            return back();
        } catch (\Exception $e) {
            alert()->error('error', 'gagal');
            return back();
        }
    }
    public function hapus($id)
    {
        $Produk = Product::where('id', $id)->first();
        try {
            $Produk->delete();
            History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghancurkan produk', 'tanggal' => date("d-m-Y")]);
            alert()->success('Sukses', 'Berhasil menghancurkan');
            return back();
        } catch (\Exception $e) {
            alert()->error('error', 'gagl');
            return back();
        }
    }
}