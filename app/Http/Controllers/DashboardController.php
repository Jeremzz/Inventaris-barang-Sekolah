<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBaik = Barang::where('kondisi', 'baik')->count();
        $totalRingan = Barang::where('kondisi', 'rusak ringan')->count();
        $totalBerat = Barang::where('kondisi', 'rusak berat')->count();
        $totalBarang = $totalBaik + $totalRingan + $totalBerat;

        return view('dashboard', compact('totalBarang', 'totalBaik', 'totalRingan', 'totalBerat'));
    }
}
