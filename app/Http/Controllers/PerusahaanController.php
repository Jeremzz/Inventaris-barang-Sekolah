<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Dudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerusahaanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'dudi_id'       => 'required|exists:dudis,id',
            'nama_barang'   => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $storagePath = storage_path('app/public/perusahaan_fotos');
            $publicPath = public_path('storage/perusahaan_fotos');

            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0755, true);
            }

            $file->move($storagePath, $filename);
            copy($storagePath . '/' . $filename, $publicPath . '/' . $filename);

            $data['foto'] = $filename;
        }

        Perusahaan::create($data);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function showByDudi($dudi_id)
    {
        $dudi = Dudi::findOrFail($dudi_id);
        $barangs = Perusahaan::where('dudi_id', $dudi_id)->get();

        return view('dudi.detail', compact('dudi', 'barangs'));
    }

    public function update(Request $request, $id)
{
    $barang = Perusahaan::findOrFail($id);

    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'tanggal_masuk' => 'required|date',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $barang->nama_barang = $request->nama_barang;
    $barang->tanggal_masuk = $request->tanggal_masuk;

    if ($request->hasFile('foto')) {
        // Hapus foto lama
        if ($barang->foto) {
            File::delete(storage_path('app/public/perusahaan_fotos/' . $barang->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $storagePath = storage_path('app/public/perusahaan_fotos');
        $publicPath = public_path('storage/perusahaan_fotos');

        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        $file->move($storagePath, $filename);
        copy($storagePath . '/' . $filename, $publicPath . '/' . $filename);

        $barang->foto = $filename;
    }

    $barang->save();

    return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
}


    public function destroy($id)
    {
        $barang = Perusahaan::findOrFail($id);
        if ($barang->foto) {
            File::delete(storage_path('app/public/perusahaan_fotos/' . $barang->foto));
        }
        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}
