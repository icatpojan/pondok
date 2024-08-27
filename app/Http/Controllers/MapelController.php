<?php
namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
public function index()
{
    $mapel = Mapel::orderBy('id','DESC')->paginate(10);
    $title = 'mapel';
    return view('master.mapel', compact('mapel','title'));
}

public function store(Request $request)
{

    Mapel::create([
        'name' => $request->name,
    ]);

    return redirect()->route('mapel')->with('success', 'Mapel created successfully.');
}

public function update(Request $request, $id)
{
    $mapel = Mapel::findOrFail($id);


    $mapel->update([
        'name' => $request->name,
    ]);

    return redirect()->route('mapel')->with('success', 'Mapel updated successfully.');
}

public function destroy($id)
{
    $mapel = Mapel::findOrFail($id);
    $mapel->delete();

    return redirect()->route('mapel')->with('success', 'Mapel deleted successfully.');
}
}
