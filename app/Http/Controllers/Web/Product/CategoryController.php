<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $Category = Category::all();
        $title = "Category";
        return view('product.category', compact('title', 'Category'));
    }

    public function store(Request $request)
    {
        $Category = Category::create([
            'name' => $request->name,
        ]);
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menambah Kategori', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menambah');
        return back();
    }

    public function update(Request $request, $id)
    {
        $Category = Category::where('id', $id)->first();
        $Category->name = $request->name;
        $Category->update();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Mengupdate Kategori', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil mengupdate');
        return back();
    }

    public function destroy($id)
    {
        $Category = Category::where('id', $id)->first();
        $Category->delete();
        History::create(['user_id' => Auth::id(), 'keterangan' => 'Menghapus Kategori', 'tanggal' => date("d-m-Y")]);

        alert()->success('Sukses', 'Berhasil menghapus');
        return back();
    }
}