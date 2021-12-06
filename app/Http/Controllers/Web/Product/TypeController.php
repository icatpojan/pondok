<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use App\Models\Product;
use App\Models\Type;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    public function index()
    {
        $Category = Category::get(['id', 'name']);
        $Type = Type::with('category')->get();
        foreach ($Type as $type) {
            $type = Type::where('id', $type->id)->first();
            $Produk = Product::where('status_id', 1)->where('type_id', $type->id)->count();
            $type->update([
                'stock' => $Produk,
            ]);
        }
        $Type = Type::with('category')->get();
        $title = "Type";
        return view('product.type', compact('title', 'Type', 'Category'));
    }

    public function store(Request $request)
    {
        $Type = Type::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah tipe', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $Type = Type::where('id', $id)->first();
        $Type->name = $request->name;
        $Type->category_id = $request->category_id;
        $Type->price = $request->price;
        $Type->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate tipe', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil mengudate');
        return back();
    }

    public function destroy($id)
    {
        $Type = Type::where('id', $id)->first();
        $Type->delete();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus tipe', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }
}