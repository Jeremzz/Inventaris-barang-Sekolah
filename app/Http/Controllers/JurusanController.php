<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Barang;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        $semuaBarang = Barang::with('jurusan')->get();

        return view('jurusan.index', compact('jurusans','semuaBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan jurusan.');
    }
public function show($id)
{
    $jurusan = Jurusan::findOrFail($id);
    $barangs = Barang::where('jurusan_id', $id)->get();
    $jurusans = Jurusan::all();

    return view('jurusan.detail', compact('jurusan', 'barangs', 'jurusans'));
}

    public function destroy(Request $request)
    {
        Jurusan::destroy($request->delete_ids);
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
