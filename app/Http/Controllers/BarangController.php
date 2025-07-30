<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index($jurusan_id)
    {
        $jurusan = Jurusan::with('barangs')->findOrFail($jurusan_id);

        $barangs = $jurusan->barangs;

        $jurusans = Jurusan::all();


        return view('barang.index', compact('jurusan', 'barangs', 'jurusans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jurusan_id'      => 'required|exists:jurusans,id',
            'nama_barang'     => 'required|string|max:255',
            'kode_seri'       => 'required|string|max:255',
            'tahun_pengadaan' => 'required|digits:4',
            'kondisi'         => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            try {
                $storagePath = storage_path('app/public/barang_fotos');
                $publicPath = public_path('storage/barang_fotos');

                if (!File::exists($storagePath)) {
                    File::makeDirectory($storagePath, 0755, true);
                }

                if (!File::exists($publicPath)) {
                    File::makeDirectory($publicPath, 0755, true);
                }

                $file = $request->file('foto');

                $extension = $file->getClientOriginalExtension();
                $namaFile = time() . '_' . uniqid() . '.' . $extension;

                $file->move($storagePath, $namaFile);

                if (!is_link(public_path('storage'))) {
                    copy($storagePath . '/' . $namaFile, $publicPath . '/' . $namaFile);
                }

                $validatedData['foto'] = $namaFile;

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal mengupload foto: ' . $e->getMessage());
            }
        }

        Barang::create($validatedData);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
{
    $barang = Barang::findOrFail($id);
    $barang->update($request->except('foto'));

    if ($request->hasFile('foto')) {
        // proses upload seperti di store
    }

    return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
}

public function cariAjax(Request $request)
{
    $query = $request->query('query');

    $barangs = Barang::with('jurusan')
        ->where('kode_seri', 'like', "%$query%")
        ->orWhere('kondisi', 'like', "%$query%")
        ->orWhere('nama_barang', 'like', "%$query%")
        ->get();

    return response()->json($barangs);
}



    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->foto) {
            Storage::delete('public/barang_fotos/' . $barang->foto);
        }

        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}
