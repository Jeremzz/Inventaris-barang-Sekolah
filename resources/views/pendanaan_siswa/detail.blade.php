    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <title>Detail Pendanaan Siswa - SMKN 2 Kendari</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosmkn2.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
        <style>
@media print {
  @page{ size:A4; margin:2cm 1.5cm; }

  body{ background:#fff; font-family:'Times New Roman',serif; font-size:12pt; }

  body *{ visibility:hidden; }
  main, main *{ visibility:visible; }
  main{ position:absolute; left:0; top:0; width:100%; }

  .no-print{ display:none !important; }

  .print-header{
    display:block !important;
    text-align:center;
    margin-bottom:2rem;
    border-bottom:2px solid #000;
    padding-bottom:1rem;
  }
  .print-header img{ width:70px; margin-bottom:.5rem; }

  .printable-area{ box-shadow:none !important; border:none !important; }

  table{ width:100%; border-collapse:collapse; color:#000; }
  thead{ background:#e2e8f0 !important; }
  th,td{ border:1px solid #000; padding:8px; text-align:left; }

  h2.print-title{ font-size:16pt; font-weight:bold; margin-bottom:.5rem; }
}
.print-header{ display:none; }
</style>

  </head>
    <body class="bg-gray-100">

    <div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="bg-white shadow-md w-64 min-h-screen fixed z-40 no-print:">
        <div class="flex items-center p-6 border-b">
        <img src="{{ asset('img/logosmkn2.png') }}" class="w-10 h-10 mr-3" alt="Logo SMKN2">
        <span class="font-bold text-indigo-600 text-lg">SMKN 2 Kendari</span>
        </div>
        <nav class="p-4 space-y-2">
        <a href="/dashboard" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Dashboard</a>
        <a href="/jurusan" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Jurusan</a>
        <a href="/dudi" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Kerjasama DUDI</a>
        <a href="/dana-bos" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Dana BOS</a>
        <a href="/dana-dak" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Dana DAK</a>
        <a href="/pendanaan-siswa" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Pendanaan Siswa</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">Logout</button>
        </form>
        </nav>
    </aside>

    <!-- KONTEN -->
    <div class="flex-1 flex flex-col ml-64">
        <!-- HEADER -->
        <header class="bg-indigo-500 h-20 flex items-center justify-between px-6 text-white shadow z-10 no-print">
        <span class="text-xl font-bold tracking-wide">Inventaris Barang Sekolah</span>
        <span class="text-sm">Halo, Administrator</span>
        </header>

        <!-- MAIN -->
        <main class="p-6 space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-xl font-bold text-gray-800">Detail Pendanaan Siswa</h2>
            <div class="flex flex-wrap gap-2">
            <a href="{{ route('pendanaan.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow-sm text-sm no-print">← Kembali</a>
            <button onclick="window.print()"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow-sm text-sm no-print">Cetak</button>
            <button onclick="openModal('modalTambahPenggunaan')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm text-sm no-print">+ Tambah</button>
            </div>
        </div>
        {{-- HEADER CETAK (tersembunyi di layar) --}}
        <div class="print-header text-center space-y-1">
            <img src="{{ asset('img/logosmkn2.png') }}" alt="Logo SMKN2 Kendari" class="w-16 h-16 mx-auto">
            <h1 class="text-lg font-bold uppercase">Pemerintah Provinsi Sulawesi Tenggara</h1>
            <h2 class="text-md font-semibold uppercase">Dinas Pendidikan dan Kebudayaan</h2>
            <h3 class="text-2xl font-bold uppercase tracking-wide">SMK Negeri 2 Kendari</h3>
            <p class="text-sm text-gray-700">Jl. Jend. A.H. Nasution No. 103, Kambu, Kec. Kambu, Kota Kendari</p>
            </div>

        <!-- INFORMASI SISWA -->
        <div class="bg-white p-6 rounded-xl shadow-md text-gray-800 text-base space-y-3 border border-gray-200">
        <div class="flex flex-col md:flex-row md:justify-between">
            <p class="font-semibold">Nama Siswa:</p>
            <p class="text-black">{{ $pendanaan->nama_siswa }}</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between">
            <p class="font-semibold">NIS:</p>
            <p class="text-black">{{ $pendanaan->nis }}</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between">
            <p class="font-semibold">Kelas:</p>
            <p class="text-black">{{ $pendanaan->kelas }}</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between">
            <p class="font-semibold">Jenis Pendanaan:</p>
            <p class="text-black">{{ $pendanaan->jenis_pendanaan }}</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between">
            <p class="font-semibold">Tanggal:</p>
            <p class="text-black">{{ $pendanaan->tanggal }}</p>
        </div>
        </div>


        <!-- TABEL PENGGUNAAN -->
        <div class="overflow-x-auto bg-white shadow rounded-lg printable-area border">
            <table class="min-w-full table-auto align-middle">
            <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
            <tr>
                <th class="px-4 py-3 text-center">No</th>
                <th class="px-4 py-3 text-center">Nama Barang</th>
                <th class="px-4 py-3 text-center">Kode Barang</th>
                <th class="px-4 py-3 text-center">Jumlah</th>
                <th class="px-4 py-3 text-center">Harga Satuan</th>
                <th class="px-4 py-3 text-center">Total</th>
                <th class="px-4 py-3 text-center">Bukti</th>
                <th class="px-4 py-3 text-center no-print">Aksi</th>
            </tr>
            </thead>
            <tbody class="text-sm text-gray-800 divide-y">
            @forelse ($pendanaan->penggunaan as $i => $item)
                <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-center">{{ $i + 1 }}</td>
                <td class="px-4 py-3 text-center">{{ $item->nama_barang }}</td>
                <td class="px-4 py-3 text-center">{{ $item->kode_barang }}</td>
                <td class="px-4 py-3 text-center">{{ $item->jumlah }}</td>
                <td class="px-4 py-3 text-center">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">Rp{{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">
                    @if ($item->bukti_foto)
                    <img src="{{ asset('storage/foto_penggunaan_siswa/' . $item->bukti_foto) }}"
                        class="w-20 h-20 object-cover rounded cursor-pointer border hover:shadow-lg transition"
                        alt="Bukti">
                    @else
                    <span class="text-gray-400 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="px-4 py-3 align-middle">
                    <div class="flex justify-center gap-2">
                    <button onclick='openEditModal(@json($item))' class="text-yellow-500 hover:text-yellow-600" title:"Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7z"/></button>
                    <form action="{{ route('pendanaan.penggunaan.destroy', [$pendanaan->id, $item->id])}}"
                            method="POST" onsubmit="return confirm('Yakin ingin menghapus penggunaan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></button>
                    </form>
                    </div>
                </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center py-4 text-gray-500">Belum ada penggunaan dana.</td></tr>
            @endforelse
            </tbody>
            </table>
        </div>
        </main>
    </div>
    </div>

    <!-- MODAL TAMBAH -->
    <div id="modalTambahPenggunaan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-xl rounded p-6 shadow">
        <div class="flex justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-800">Tambah Penggunaan Dana</h2>
        <button onclick="closeModal('modalTambahPenggunaan')" class="text-gray-600 hover:text-gray-800 text-xl">&times;</button>
        </div>
        <form action="{{ route('pendanaan.penggunaan.store', $pendanaan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <input type="text" name="nama_barang" placeholder="Nama Barang" required class="border px-3 py-2 rounded w-full">
            <input type="text" name="kode_barang" placeholder="Kode Barang" required class="border px-3 py-2 rounded w-full">
            <input type="number" name="jumlah" placeholder="Jumlah" required class="border px-3 py-2 rounded w-full">
            <input type="number" name="harga_satuan" placeholder="Harga Satuan" required class="border px-3 py-2 rounded w-full">
            <input type="file" name="bukti_foto" class="border px-3 py-2 rounded w-full text-sm">
        </div>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('modalTambahPenggunaan')" class="px-4 py-2 bg-gray-300 rounded mr-2">Batal</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
        </div>
        </form>
    </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="modalEditPenggunaan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-xl rounded p-6 shadow">
        <div class="flex justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Penggunaan Dana</h2>
        <button onclick="closeModal('modalEditPenggunaan')" class="text-gray-600 hover:text-gray-800 text-xl">&times;</button>
        </div>
        <form id="formEditPenggunaan" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4">
            <input type="text" name="nama_barang" id="edit_nama_barang" placeholder="Nama Barang" required class="border px-3 py-2 rounded w-full">
            <input type="text" name="kode_barang" id="edit_kode_barang" placeholder="Kode Barang" required class="border px-3 py-2 rounded w-full">
            <input type="number" name="jumlah" id="edit_jumlah" placeholder="Jumlah" required class="border px-3 py-2 rounded w-full">
            <input type="number" name="harga_satuan" id="edit_harga_satuan" placeholder="Harga Satuan" required class="border px-3 py-2 rounded w-full">
            <input type="file" name="bukti_foto" class="border px-3 py-2 rounded w-full text-sm">
        </div>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('modalEditPenggunaan')" class="px-4 py-2 bg-gray-300 rounded mr-2">Batal</button>
            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded">Update</button>
        </div>
        </form>
    </div>
    </div>

    <!-- MODAL CETAK -->
    <div id="modalCetakPendanaan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Cetak Laporan Pendanaan</h2>
        <button onclick="closeModal('modalCetakPendanaan')" class="text-xl text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        <form action="{{ route('pendanaan-siswa.print') }}" method="GET" target="_blank">
        <input type="hidden" name="id" value="{{ $pendanaan->id }}">
        <div class="mb-4">
            <label class="block text-sm text-gray-700">Apakah Anda yakin ingin mencetak laporan ini?</label>
        </div>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('modalCetakPendanaan')" class="px-4 py-2 bg-gray-300 rounded mr-2">
            Batal
            </button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
            Cetak
            </button>
        </div>
        </form>
    </div>
    </div>

    <!-- SCRIPT MODAL -->
    <script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }

    function openEditModal(item) {
    // Isi form edit
    document.getElementById('edit_nama_barang').value = item.nama_barang;
    document.getElementById('edit_kode_barang').value = item.kode_barang;
    document.getElementById('edit_jumlah').value = item.jumlah;
    document.getElementById('edit_harga_satuan').value = item.harga_satuan;

    // Ubah action form ke route edit
    const form = document.getElementById('formEditPenggunaan');
    const pendanaanId = {{ $pendanaan->id }};
    form.action = `/pendanaan-siswa/${pendanaanId}/penggunaan/${item.id}`;

    openModal('modalEditPenggunaan');
        }
    </script>
    </body>
    </html>
