<?php

namespace App\Http\Controllers;

use App\Models\DanaDak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DanaDakController extends Controller
{
    public function index()
    {
        $danaDak = DanaDak::orderBy('tanggal_masuk', 'desc')->get();
        return view('dana_dak.index', compact('danaDak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'sumber' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['tanggal_masuk', 'sumber']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = storage_path('app/public/dana_dak_foto');
            $publicPath = public_path('storage/dana_dak_foto');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $file->move($path, $filename);
            copy($path . '/' . $filename, $publicPath . '/' . $filename);

            $data['foto'] = $filename;
        }

        DanaDak::create($data);

        return redirect()->back()->with('success', 'Data Dana DAK berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $dak = DanaDak::findOrFail($id);

        $request->validate([
            'tanggal_masuk' => 'required|date',
            'sumber' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $dak->tanggal_masuk = $request->tanggal_masuk;
        $dak->sumber = $request->sumber;

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($dak->foto) {
                File::delete(storage_path('app/public/dana_dak_foto/' . $dak->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/dana_dak_foto'), $filename);
            $dak->foto = $filename;
        }

        $dak->save();

        return redirect()->back()->with('success', 'Data Dana DAK berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dak = DanaDak::findOrFail($id);
        if ($dak->foto) {
            File::delete(storage_path('app/public/dana_dak_foto/' . $dak->foto));
        }
        $dak->delete();

        return redirect()->back()->with('success', 'Data Dana DAK berhasil dihapus.');
    }

    public function cari(Request $request)
    {
        $tanggal = $request->query('tanggal');
        $hasil = DanaDak::whereDate('tanggal_masuk', $tanggal)->get();

        return response()->json($hasil);
    }
}
