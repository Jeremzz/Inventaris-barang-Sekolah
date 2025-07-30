<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dudi;

class DudiController extends Controller
{
    public function index()
    {
        $dudis = Dudi::all();
        return view('dudi.index', compact('dudis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
        ]);

        Dudi::create([
            'nama_perusahaan' => $request->nama_perusahaan
        ]);

        return redirect()->route('dudi.index')->with('success', 'Data kerjasama DUDI berhasil ditambahkan');
    }

    public function show($id)
    {
        $dudi = Dudi::findOrFail($id);
        return view('dudi.detail', compact('dudi'));
    }

    public function cariAjax(Request $request)
    {
        $keyword = $request->query('query');
        $dudi = Dudi::where('nama_perusahaan', 'like', '%' . $keyword . '%')->get();
        return response()->json($dudi);
    }

    public function destroy(Request $request)
    {
        Dudi::destroy($request->delete_ids);
        return redirect()->route('dudi.index')->with('success', 'Kerjasama DUDI berhasil dihapus');
    }
}
