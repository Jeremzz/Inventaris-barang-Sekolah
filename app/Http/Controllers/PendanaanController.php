<?php

namespace App\Http\Controllers;

use App\Models\Pendanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PendanaanController extends Controller
{
    public function index()
    {
        $pendanaan = Pendanaan::orderBy('tanggal_pemberian', 'desc')->get();
        return view('pendanaan.index', compact('pendanaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'barang' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|integer|min:0',
            'tanggal_pemberian' => 'required|date',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/pendanaan_foto'), $filename);
            $data['foto'] = $filename;
        }

        Pendanaan::create($data);

        return redirect()->back()->with('success', 'Data pendanaan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pendanaan = Pendanaan::findOrFail($id);

        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'barang' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|integer|min:0',
            'tanggal_pemberian' => 'required|date',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pendanaan->fill($request->except('foto'));

        if ($request->hasFile('foto')) {
            if ($pendanaan->foto) {
                File::delete(storage_path('app/public/pendanaan_foto/' . $pendanaan->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/pendanaan_foto'), $filename);
            $pendanaan->foto = $filename;
        }

        $pendanaan->save();

        return redirect()->back()->with('success', 'Data pendanaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendanaan = Pendanaan::findOrFail($id);
        if ($pendanaan->foto) {
            File::delete(storage_path('app/public/pendanaan_foto/' . $pendanaan->foto));
        }
        $pendanaan->delete();

        return redirect()->back()->with('success', 'Data pendanaan berhasil dihapus.');
    }

    public function cari(Request $request)
    {
        $keyword = $request->query('keyword');
        $hasil = Pendanaan::where('nama_siswa', 'like', '%' . $keyword . '%')
            ->orWhere('kode_barang', 'like', '%' . $keyword . '%')
            ->orWhere('barang', 'like', '%' . $keyword . '%')
            ->orWhere('kelas', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($hasil);
    }
}
