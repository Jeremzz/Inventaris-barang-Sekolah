<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Perusahaan {{ $dudi->nama_perusahaan }} - SMKN 2 Kendari</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosmkn2.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    @media print {
        @page {
            size: A4;
            margin: 2cm 1.5cm;
        }

        body * {
            visibility: hidden;
        }

        main, main * {
            visibility: visible;
        }

        main {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }

        .print-header {
            display: block !important;
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid #000;
            padding-bottom: 1rem;
        }

        .print-header img {
            width: 70px;
            margin-bottom: 0.5rem;
        }

        body {
            background-color: #fff;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .printable-area {
            box-shadow: none !important;
            border: none !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #000;
        }

        thead {
            background-color: #e2e8f0 !important;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        h2.print-title {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
    }

    .print-header {
        display: none;
    }
</style>

    </head>
    <body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white shadow-md w-64 min-h-screen fixed md:relative z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-200">
            <div class="flex items-center p-6 border-b">
            <img src="{{ asset('img/logosmkn2.png') }}" class="w-10 h-10 mr-3" alt="Logo SMKN2" />
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
                    <button type="submit" class="w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col ml-64 md:ml-0">
        <!-- HEADER -->
        <header class="bg-indigo-500 h-20 flex items-center justify-between px-6 text-white shadow z-10">
            <span class="text-xl font-bold tracking-wide">Kerjasama DUDI</span>
            <span class="text-sm">Halo, Administrator</span>
        </header>

        <!-- MAIN CONTENT -->
        <main class="p-6 space-y-6">
            <!-- PRINT HEADER -->
            <div class="print-header text-center space-y-1">
            <img src="{{ asset('img/logosmkn2.png') }}" alt="Logo SMKN2 Kendari" class="w-16 h-16 mx-auto">
            <h1 class="text-lg font-bold uppercase">Pemerintah Provinsi Sulawesi Tenggara</h1>
            <h2 class="text-md font-semibold uppercase">Dinas Pendidikan dan Kebudayaan</h2>
            <h3 class="text-2xl font-bold uppercase tracking-wide">SMK Negeri 2 Kendari</h3>
            <p class="text-sm text-gray-700">Jl. Jend. A.H. Nasution No. 103, Kambu, Kec. Kambu, Kota Kendari</p>
            </div>

            <!-- JUDUL DAN AKSI -->
            <div class="flex flex-wrap justify-between items-center no-print">
                <h2 class="text-xl font-bold text-gray-800 mb-2 md:mb-0">Barang Perusahaan: {{ $dudi->nama_perusahaan }}</h2>

                <div class="flex gap-2">
                    <a href="{{ route('dudi.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow-sm text-sm">
                        ← Kembali
                    </a>
                    <button onclick="window.print()"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow-sm text-sm">
                        Cetak Laporan
                    </button>
                    <button onclick="openModal('tambahBarangModal')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm text-sm">
                        + Tambah Barang
                    </button>
                </div>
            </div>


            <!-- TABEL BARANG -->
            <div class="overflow-x-auto bg-white shadow rounded-lg border">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Nama Barang</th>
                        <th class="px-4 py-3 text-center">Tanggal Masuk</th>
                        <th class="px-4 py-3 text-center">Foto</th>
                        <th class="px-4 py-3 text-center no-print">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800 divide-y">
                    @forelse ($dudi->perusahaanBarangs as $index => $barang)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-center">{{ $barang->nama_barang }}</td>
                            <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($barang->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($barang->foto)
                                    <img src="{{ asset('storage/perusahaan_fotos/' . $barang->foto) }}"
                                         alt="Foto"
                                         class="w-20 h-20 object-cover rounded mx-auto cursor-pointer border"
                                         onclick="showFullImage('{{ asset('storage/perusahaan_fotos/' . $barang->foto) }}')">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 no-print text-center">
                                <div class="flex justify-center items-center gap-3 h-full min-h-[60px]">
                                    <!-- Tombol Edit -->
                                    <button onclick='openEditModal(@json($barang))' class="text-yellow-500 hover:text-yellow-600" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512">
                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7z"/>
                                        </svg>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('perusahaan.destroy', $barang->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus barang ini?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 448 512">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada barang yang masuk.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Barang Perusahaan -->
    <div id="tambahBarangModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-2xl font-bold text-gray-800">Tambah Barang Baru</h3>
                <button onclick="closeModal('tambahBarangModal')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-5">
                <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dudi_id" value="{{ $dudi->id }}">
                    <div class="space-y-4">
                        <div>
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Contoh: Laptop Dell">
                        </div>
                        <div>
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Barang (Maks. 2 MB)</label>
                            <input type="file" name="foto" id="foto"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @if ($errors->has('foto'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('foto') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="button" onclick="closeModal('tambahBarangModal')"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded mr-2">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                            Simpan Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Barang Perusahaan -->
    <div id="editBarangModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-2xl font-bold text-gray-800">Edit Barang</h3>
                <button onclick="closeModal('editBarangModal')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mt-5">
                <form id="editBarangForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="dudi_id" value="{{ $dudi->id }}">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" name="nama_barang" id="edit_nama_barang"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="edit_tanggal_masuk"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ganti Foto (Opsional)</label>
                            <input type="file" name="foto"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">

                        <button type="button" onclick="closeModal('editBarangModal')"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded mr-2">
                            Batal
                        </button>
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">
                            Update Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Perbesar Gambar -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="relative">
            <button onclick="closeImageModal()" class="absolute top-0 right-0 mt-2 mr-2 text-white text-xl font-bold">&times;</button>
            <img id="modalImage" src="" alt="Perbesar Foto" class="max-h-[90vh] max-w-[90vw] rounded shadow-lg">
        </div>
        </div>

    <script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    window.onclick = function(event) {
        const modals = ['tambahBarangModal'];
        modals.forEach(id => {
            const modal = document.getElementById(id);
            if (event.target === modal) {
                closeModal(id);
            }
        });
    };

    function showFullImage(src) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modalImg.src = src;
        modal.classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    function openEditModal(barang) {
        // Isi nilai input
        document.getElementById('edit_nama_barang').value = barang.nama_barang;
        document.getElementById('edit_tanggal_masuk').value = barang.tanggal_masuk;

        // Atur URL form-nya
        const form = document.getElementById('editBarangForm');
        form.action = `/perusahaan/${barang.id}`;

        // Tampilkan modal
        openModal('editBarangModal');
    }
    </script>
    </div>
</body>
</html>
