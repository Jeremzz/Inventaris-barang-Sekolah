<?php

namespace App\Http\Controllers;

use App\Models\PendanaanSiswa;
use App\Models\PenggunaanDanaSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PendanaanSiswaController extends Controller
{
    public function index()
    {
        $pendanaan = PendanaanSiswa::with('penggunaan')->orderBy('tanggal', 'desc')->get();
        return view('pendanaan_siswa.index', compact('pendanaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string',
            'nis' => 'required|string|unique:pendanaan_siswas,nis',
            'kelas' => 'required|string',
            'jenis_pendanaan' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        PendanaanSiswa::create($request->all());
        return redirect()->back()->with('success', 'Pendanaan siswa berhasil ditambahkan.');
            }

            public function update(Request $request, $id)
        {
            $request->validate([
                'nama_siswa'      => 'required|string',
                'nis'             => "required|string|unique:pendanaan_siswas,nis,$id", // abaikan NIS milik sendiri
                'kelas'           => 'required|string',
                'jenis_pendanaan' => 'required|string',
                'tanggal'         => 'required|date',
                'keterangan'      => 'nullable|string',
            ]);

            $pendanaan = PendanaanSiswa::findOrFail($id);
            $pendanaan->update($request->all());

            return redirect()->back()->with('success', 'Pendanaan siswa berhasil diperbarui.');
        }

        public function destroy($id)
        {
            PendanaanSiswa::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Pendanaan siswa berhasil dihapus.');
        }

    public function show($id)
    {
        $pendanaan = PendanaanSiswa::with('penggunaan')->findOrFail($id);
        return view('pendanaan_siswa.detail', compact('pendanaan'));
    }

    public function storePenggunaan(Request $request, $pendanaan_id)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kode_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_barang', 'kode_barang', 'jumlah', 'harga_satuan']);
        $data['pendanaan_id'] = $pendanaan_id;

        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/foto_penggunaan_siswa'), $filename);
            $data['bukti_foto'] = $filename;
        }

        PenggunaanDanaSiswa::create($data);
        return redirect()->back()->with('success', 'Penggunaan dana berhasil ditambahkan.');
    }

    public function updatePenggunaan(Request $request, $pendanaan_id, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kode_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $penggunaan = PenggunaanDanaSiswa::findOrFail($id);
        $penggunaan->nama_barang = $request->nama_barang;
        $penggunaan->kode_barang = $request->kode_barang;
        $penggunaan->jumlah = $request->jumlah;
        $penggunaan->harga_satuan = $request->harga_satuan;

        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_penggunaan_siswa', $filename);
            $penggunaan->bukti_foto = $filename;
        }

        $penggunaan->save();

        return redirect()->back()->with('success', 'Data penggunaan berhasil diperbarui.');
    }

    public function print(Request $request)
    {
        $id = $request->query('id');
        $pendanaan = PendanaanSiswa::with('penggunaan')->findOrFail($id);
        return view('pendanaan_siswa.print', compact('pendanaan'));
    }

    public function destroyPenggunaan($pendanaan_id, $id)
    {
        $penggunaan = PenggunaanDanaSiswa::where('pendanaan_id', $pendanaan_id)->findOrFail($id);

        if ($penggunaan->bukti_foto) {
            File::delete(storage_path('app/public/foto_penggunaan_siswa/' . $penggunaan->bukti_foto));
        }

        $penggunaan->delete();
        return redirect()->back()->with('success', 'Data penggunaan berhasil dihapus.');
    }

}
