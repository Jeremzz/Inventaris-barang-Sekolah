<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Jurusan - SMKN 2 Kendari</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logosmkn2.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <!-- Wrapper Flex Horizontal -->
  <div class="flex flex-1 relative">

    <!-- Sidebar -->
    <aside class="bg-white shadow-md w-64 min-h-screen fixed z-40">
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

  <div class="ml-64 w-full flex flex-col min-h-screen">
    <header class="bg-indigo-500 h-20 flex items-center justify-between px-6 text-white shadow z-10">
        <button onclick="toggleSidebar()" class="md:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
      <span class="text-xl font-bold">Inventaris Barang Sekolah</span>
      <span class="text-sm">Halo, Administrator</span>
    </header>
    <main class="p-6">
      @if (session('success'))
      <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-semibold">
          {{ session('success') }}
      </div>
      @endif

      @if (session('error'))
      <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 font-semibold">
          {{ session('error') }}
      </div>
      @endif

      <div class="mb-8">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
    <h2 class="text-2xl md:text-2xl font-bold text-gray-800 tracking-wide">Manajemen Jurusan</h2>

    <div class="flex flex-col gap-3 w-full md:w-auto">
      <!-- Form Tambah Jurusan -->
      <form action="{{ route('jurusan.store') }}" method="POST" class="flex flex-col sm:flex-row gap-2">
        @csrf
        <input type="text" name="nama_jurusan" required placeholder="Masukkan nama jurusan baru"
          class="border border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm w-full sm:w-auto" />
        <button type="submit"
          class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow text-sm font-medium transition">
          + Tambah Jurusan
        </button>
      </form>

      <!-- Button Cari Barang -->
      <div class="flex justify-end">
        <button onclick="openModal('modalCariBarang')" type="button"
          class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm shadow font-medium transition">
        Cari Barang
        </button>
      </div>
    </div>
  </div>

  <!-- Tabel Jurusan -->
  <form method="POST" action="{{ route('jurusan.destroy') }}">
    @csrf
    <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200">
      <table class="min-w-full table-auto">
        <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
          <tr>
            <th class="px-4 py-3 text-center">
              <input type="checkbox" onclick="toggleAll(this)" class="scale-110">
            </th>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3 text-left">Nama Jurusan</th>
          </tr>
        </thead>
        <tbody class="text-sm text-gray-800 divide-y">
          @forelse ($jurusans as $index => $jurusan)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-center">
              <input type="checkbox" name="delete_ids[]" value="{{ $jurusan->id }}" class="scale-110 checkbox-item">
            </td>
            <td class="px-4 py-3 font-semibold text-black text-center">{{ $index + 1 }}</td>
            <td class="px-4 py-3">
              <a href="{{ route('jurusan.detail', $jurusan->id) }}"
                class="text-indigo-700 hover:underline font-medium tracking-wide">
                {{ $jurusan->nama_jurusan }}
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center text-gray-500 py-4 text-sm">Belum ada jurusan</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol Hapus -->
    <div class="mt-4 text-left">
      <button type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan yang dipilih?')"
        class="bg-red-600 hover:bg-red-700 text-white py-2 px-5 rounded-lg text-sm shadow font-medium transition">
         Hapus Terpilih
      </button>
    </div>
  </form>
</div>


    <!-- Modal Cari Barang -->
    <div id="modalCariBarang" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
        <h3 class="text-lg font-semibold text-gray-800">Cari Barang Berdasarkan Kode/Kondisi</h3>
        <button onclick="closeModal('modalCariBarang')" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        </div>

        <form id="formCariBarang" class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Masukkan Kode atau Kondisi Barang</label>
        <input type="text" name="cari" id="cari" placeholder="Contoh: 38299 atau Baik"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">

        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('modalCariBarang')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Tutup</button>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Cari</button>
        </div>
        </form>

        <!-- Hasil pencarian -->
        <div id="hasilPencarian" class="mt-6 hidden">
        <h4 class="text-md font-bold mb-2">Hasil:</h4>
        <table class="w-full text-sm border">
            <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama Barang</th>
                <th class="p-2 border">Kode</th>
                <th class="p-2 border">Tahun</th>
                <th class="p-2 border">Kondisi</th>
                <th class="p-2 border">Foto</th>
                <th class="p-2 border">Jurusan</th>
            </tr>
            </thead>
            <tbody id="hasilTableBody" class="text-gray-700">
            <!-- hasil ditampilkan via JS -->
            </tbody>
        </table>
        </div>
    </div>
    </div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    }
    function toggleAll(source) {
        document.querySelectorAll('input.checkbox-item').forEach(cb => cb.checked = source.checked);
    }
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    window.onclick = function(event) {
        let modal = document.getElementById('tambahBarangModal');
        if (event.target == modal) {
            closeModal('tambahBarangModal');
        }
    }
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    function showFullImage(imageUrl) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modalImg.src = imageUrl;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<script>
document.getElementById('formCariBarang').addEventListener('submit', function(e) {
    e.preventDefault();

    let keyword = document.getElementById('cari').value;
    let hasilDiv = document.getElementById('hasilPencarian');
    let tbody = document.getElementById('hasilTableBody');

    fetch(`/barang/cari/ajax?query=${encodeURIComponent(keyword)}`)
        .then(response => response.json())
        .then(data => {
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center p-2 text-gray-500">Tidak ditemukan</td></tr>`;
            } else {
                data.forEach((barang, index) => {
                    let foto = barang.foto
                        ? `<img src="/storage/barang_fotos/${barang.foto}" class="w-16 h-16 object-cover rounded mx-auto cursor-pointer" onclick="showFullImage('/storage/barang_fotos/${barang.foto}')" />`
                        : `<span class="text-gray-400 text-sm">Tidak ada</span>`;

                    tbody.innerHTML += `
                        <tr>
                            <td class="border p-2">${index + 1}</td>
                            <td class="border p-2">${barang.nama_barang}</td>
                            <td class="border p-2">${barang.kode_seri}</td>
                            <td class="border p-2">${barang.tahun_pengadaan}</td>
                            <td class="border p-2">${barang.kondisi}</td>
                            <td class="border p-2 text-center">${foto}</td>
                            <td class="border p-2">${barang.jurusan?.nama_jurusan || '-'}</td>
                        </tr>
                    `;
                });
            }

            hasilDiv.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Gagal mencari barang:', error);
        });
});

</script>

<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
    <span onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-3xl cursor-pointer">&times;</span>
    <img id="modalImage" src="" class="max-w-full max-h-[90vh] rounded shadow-lg border-4 border-white">
    </div>
</body>
</html>
