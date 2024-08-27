<?php
namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
public function index()
{
    $kelas = Kelas::orderBy('id','DESC')->paginate(10);
    $title = 'kelas';
    return view('master.kelas', compact('kelas','title'));
}

public function store(Request $request)
{

    Kelas::create([
        'name' => $request->name,
    ]);

    return redirect()->route('kelas')->with('success', 'Kelas created successfully.');
}

public function update(Request $request, $id)
{
    $kelas = Kelas::findOrFail($id);


    $kelas->update([
        'name' => $request->name,
    ]);

    return redirect()->route('kelas')->with('success', 'Kelas updated successfully.');
}

public function destroy($id)
{
    $kelas = Kelas::findOrFail($id);
    $kelas->delete();

    return redirect()->route('kelas')->with('success', 'Kelas deleted successfully.');
}
}
