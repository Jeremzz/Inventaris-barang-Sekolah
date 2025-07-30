<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\DanaBosController;
use App\Http\Controllers\DanaDakController;
use App\Http\Controllers\PendanaanSiswaController;
use App\Http\Controllers\PendanaanController;

// Halaman Utama
Route::get('/cari', function () {
    return view('guest.index');
});

Route::get('/', function () {
    return view('guest.index');
});

    Route::get('/search', function (Request $request) {
    $query = $request->query('query');

    $barangs = DB::table('barangs')
        ->join('jurusans', 'barangs.jurusan_id', '=', 'jurusans.id')
        ->where(function ($q) use ($query) {
            $q->where('barangs.nama_barang', 'like', "%$query%")
              ->orWhere('barangs.kode_seri', '=', $query)
              ->orWhere('jurusans.nama_jurusan', 'like', "%$query%");
        })
        ->select(
            'barangs.nama_barang',
            'barangs.kode_seri',
            'barangs.tahun_pengadaan',
            'barangs.kondisi',
            'barangs.foto',
            DB::raw("NULL as tanggal_masuk"),
            DB::raw("NULL as sumber"),
            DB::raw("'barangs' as sumber_tabel"),
            'jurusans.nama_jurusan'
        )->get();

    $bos = DB::table('dana_bos')
        ->where(function ($q) use ($query) {
            $q->where('sumber', 'like', "%$query%")
              ->orWhere('tanggal_masuk', 'like', "%$query%");
        })
        ->select(
            DB::raw("NULL as nama_barang"),
            DB::raw("NULL as kode_seri"),
            DB::raw("NULL as tahun_pengadaan"),
            DB::raw("NULL as kondisi"),
            'foto',
            'tanggal_masuk',
            'sumber',
            DB::raw("'dana_bos' as sumber_tabel"),
            DB::raw("NULL as nama_jurusan")
        )->get();

    $daks = DB::table('dana_daks')
        ->where(function ($q) use ($query) {
            $q->where('sumber', 'like', "%$query%")
              ->orWhere('tanggal_masuk', 'like', "%$query%");
        })
        ->select(
            DB::raw("NULL as nama_barang"),
            DB::raw("NULL as kode_seri"),
            DB::raw("NULL as tahun_pengadaan"),
            DB::raw("NULL as kondisi"),
            'foto',
            'tanggal_masuk',
            'sumber',
            DB::raw("'dana_daks' as sumber_tabel"),
            DB::raw("NULL as nama_jurusan")
        )->get();

    $pendanaan = DB::table('pendanaan_siswas')
    ->join('penggunaan_dana_siswas', 'pendanaan_siswas.id', '=', 'penggunaan_dana_siswas.pendanaan_id')
    ->where(function ($q) use ($query) {
        $q->where('pendanaan_siswas.nama_siswa', 'like', "%$query%")
          ->orWhere('pendanaan_siswas.nis', 'like', "%$query%")
          ->orWhere('pendanaan_siswas.kelas', 'like', "%$query%")
          ->orWhere('pendanaan_siswas.jenis_pendanaan', 'like', "%$query%")
          ->orWhere('penggunaan_dana_siswas.nama_barang', 'like', "%$query%")
          ->orWhere('penggunaan_dana_siswas.kode_barang', 'like', "%$query%");
    })
    ->select(
    'penggunaan_dana_siswas.nama_barang',
    'penggunaan_dana_siswas.kode_barang as kode_seri',
    DB::raw("NULL as tahun_pengadaan"),
    DB::raw("NULL as kondisi"),
    'penggunaan_dana_siswas.bukti_foto as foto',
    'pendanaan_siswas.tanggal as tanggal_masuk',
    'pendanaan_siswas.jenis_pendanaan as sumber',
    DB::raw("'pendanaan_siswa' as sumber_tabel"),
    DB::raw("NULL as nama_jurusan"),
    'pendanaan_siswas.nama_siswa',
    'pendanaan_siswas.nis',
    'pendanaan_siswas.kelas',
    'penggunaan_dana_siswas.jumlah',
    'penggunaan_dana_siswas.harga_satuan',
    'penggunaan_dana_siswas.total_harga'
    )->get();


    return response()->json($barangs->merge($bos)->merge($daks)->merge($pendanaan));
});


// Halaman Login
Route::get('/loginaset', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Grup route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Jurusan
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::post('/jurusan/delete', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    Route::get('/jurusan/{id}', [JurusanController::class, 'show'])->name('jurusan.detail');

    // Manajemen Barang
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('/barang/cari/ajax', [BarangController::class, 'cariAjax']);
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Manajemen Dudi
    Route::get('/dudi', [DudiController::class, 'index'])->name('dudi.index');
    Route::post('/dudi', [DudiController::class, 'store'])->name('dudi.store');
    Route::get('/dudi/{id}', [DudiController::class, 'show'])->name('dudi.detail');
    Route::post('/dudi/delete', [DudiController::class, 'destroy'])->name('dudi.destroy');
    Route::get('/dudi/cari/ajax', [DudiController::class, 'cariAjax']);

    // Manajemen Perusahaan
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/perusahaan/store', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/dudi/{id}/detail', [PerusahaanController::class, 'showByDudi'])->name('dudi.detail');
    Route::delete('/perusahaan/{id}/destroy', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');

    // Manajemen Bos
Route::get('/dana-bos', [DanaBosController::class, 'index'])->name('dana-bos.index');
Route::post('/dana-bos', [DanaBosController::class, 'store'])->name('dana-bos.store');
Route::put('/dana-bos/{id}', [DanaBosController::class, 'update'])->name('dana-bos.update');
Route::delete('/dana-bos/{id}', [DanaBosController::class, 'destroy'])->name('dana-bos.destroy');
Route::get('/dana-bos/cari', [DanaBosController::class, 'cari']);

    // Manajemen Dak
Route::get('/dana-dak', [DanaDakController::class, 'index'])->name('dana-dak.index');
Route::post('/dana-dak', [DanaDakController::class, 'store'])->name('dana-dak.store');
Route::put('/dana-dak/{id}', [DanaDakController::class, 'update'])->name('dana-dak.update');
Route::delete('/dana-dak/{id}', [DanaDakController::class, 'destroy'])->name('dana-dak.destroy');
Route::get('/dana-dak/cari', [DanaDakController::class, 'cari'])->name('dana-dak.cari');

    // Pendanaan
Route::get('/pendanaan-siswa', [PendanaanSiswaController::class, 'index'])->name('pendanaan.index');
Route::post('/pendanaan-siswa', [PendanaanSiswaController::class, 'store'])->name('pendanaan-siswa.store');
Route::get('/pendanaan-siswa/{id}', [PendanaanSiswaController::class, 'show'])->name('pendanaan-siswa.show');
Route::put   ('/pendanaan-siswa/{id}', [PendanaanSiswaController::class, 'update'])->name('pendanaan-siswa.update');
Route::delete('/pendanaan-siswa/{id}', [PendanaanSiswaController::class, 'destroy'])->name('pendanaan-siswa.destroy');
Route::post('/pendanaan-siswa/{id}/penggunaan', [PendanaanSiswaController::class, 'storePenggunaan'])->name('pendanaan.penggunaan.store');
Route::put('/pendanaan-siswa/{pendanaan}/penggunaan/{id}', [PendanaanSiswaController::class, 'updatePenggunaan'])->name('pendanaan.penggunaan.update');
Route::delete('/pendanaan-siswa/{pendanaan}/penggunaan/{id}', [PendanaanSiswaController::class, 'destroyPenggunaan'])->name('pendanaan.penggunaan.destroy');
Route::get('/pendanaan-siswa/print', [PendanaanSiswaController::class, 'print'])->name('pendanaan-siswa.print');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
