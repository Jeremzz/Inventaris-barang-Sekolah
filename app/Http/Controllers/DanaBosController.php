<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanaBos;
use Illuminate\Support\Facades\File;

class DanaBosController extends Controller
{
    public function index()
    {
        $danaBos = DanaBos::latest()->get();
        return view('dana_bos.index', compact('danaBos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'sumber' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['tanggal_masuk', 'sumber']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = storage_path('app/public/dana_bos_foto');
            $publicPath = public_path('storage/dana_bos_foto');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $file->move($path, $filename);
            copy($path . '/' . $filename, $publicPath . '/' . $filename);

            $data['foto'] = $filename;
        }

        DanaBos::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $bos = DanaBos::findOrFail($id);

        $request->validate([
            'tanggal_masuk' => 'required|date',
            'sumber' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $bos->tanggal_masuk = $request->tanggal_masuk;
        $bos->sumber = $request->sumber;

        if ($request->hasFile('foto')) {
            if ($bos->foto) {
                File::delete([
                    storage_path('app/public/dana_bos_foto/' . $bos->foto),
                    public_path('storage/dana_bos_foto/' . $bos->foto),
                ]);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = storage_path('app/public/dana_bos_foto');
            $publicPath = public_path('storage/dana_bos_foto');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $file->move($path, $filename);
            copy($path . '/' . $filename, $publicPath . '/' . $filename);

            $bos->foto = $filename;
        }

        $bos->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function cari(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $hasil = DanaBos::whereDate('tanggal_masuk', $tanggal)->get();

        return response()->json($hasil);
    }

    public function destroy($id)
    {
        $bos = DanaBos::findOrFail($id);

        if ($bos->foto) {
            File::delete([
                storage_path('app/public/dana_bos_foto/' . $bos->foto),
                public_path('storage/dana_bos_foto/' . $bos->foto),
            ]);
        }

        $bos->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
