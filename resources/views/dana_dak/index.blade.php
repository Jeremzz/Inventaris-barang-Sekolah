<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dana DAK - SMKN 2 Kendari</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logosmkn2.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
<div class="flex flex-1 relative">

  <!-- Sidebar -->
  <aside class="bg-white shadow-md w-64 min-h-screen fixed z-40" id="sidebar">
    <div class="flex items-center p-6 border-b">
      <img src="{{ asset('img/logosmkn2.png') }}" class="w-10 h-10 mr-3" alt="Logo SMKN2" />
      <span class="font-bold text-indigo-600 text-lg">SMKN 2 Kendari</span>
    </div>
    <nav class="p-4 space-y-2">
      <a href="/dashboard" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Dashboard</a>
      <a href="/jurusan" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Jurusan</a>
      <a href="/dudi" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Kerjasama DUDI</a>
      <a href="/dana-bos" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Dana BOS</a>
      <a href="/dana-dak" class="block py-2 px-4 rounded bg-indigo-100 text-indigo-700 font-semibold">Dana DAK</a>
      <a href="/pendanaan-siswa" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Pendanaan Siswa</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">
          Logout
        </button>
      </form>
    </nav>
  </aside>

  <!-- Main Area -->
  <div class="ml-64 w-full flex flex-col min-h-screen">
    <header class="bg-indigo-500 h-20 flex items-center justify-between px-6 text-white shadow z-10">
      <button onclick="toggleSidebar()" class="md:hidden text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
      <span class="text-xl font-bold">Dana DAK</span>
      <span class="text-sm">Halo, Administrator</span>
    </header>

    <main class="p-6">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Manajemen Dana DAK</h2>
        <button onclick="openModal('modalTambahDanaDak')"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm shadow font-medium">
            + Tambah Data
        </button>
      </div>

      <!-- Tombol Cari -->
      <div class="mb-4 text-right">
        <button onclick="openModal('modalCariTanggal')" type="button"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm shadow font-medium transition">
          Cari Surat
        </button>
      </div>

      <!-- Tabel Data -->
      <div class="overflow-x-auto bg-white shadow rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
          <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
          <tr>
            <th class="px-4 py-3 text-center">No</th>
            <th class="px-4 py-3 text-center">Tanggal Masuk Surat</th>
            <th class="px-4 py-3 text-center">Sumber</th>
            <th class="px-4 py-3 text-center">Foto Surat</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
          </thead>
          <tbody class="text-sm text-gray-800 divide-y">
          @forelse ($danaDak as $index => $dak)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
              <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($dak->tanggal_masuk)->format('d-m-Y') }}</td>
              <td class="px-4 py-3 text-center">{{ $dak->sumber }}</td>
              <td class="px-4 py-3 text-center">
                @if ($dak->foto)
                  <img src="{{ asset('storage/dana_dak_foto/' . $dak->foto) }}"
                       class="w-20 h-20 object-cover rounded mx-auto cursor-pointer border"
                       onclick="showFullImage('{{ asset('storage/dana_dak_foto/' . $dak->foto) }}')">
                @else
                  <span class="text-gray-400 italic">Tidak ada</span>
                @endif
              </td>
              <td class="px-4 py-3 text-center">
                <div class="flex justify-center gap-3">
                  <button onclick='openEditModal(@json($dak))' class="text-yellow-500 hover:text-yellow-600" title="Edit">
                    <!-- SVG edit -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512">
                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7z"/>
                            </svg>
                  </button>
                  <form action="{{ route('dana-dak.destroy', $dak->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus surat ini?')" class="inline-block">
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
              <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data surat Dana DAK.</td>
            </tr>
          @endforelse
        </tbody>
    </table>
</div>
</main>
</div>
</div>

<!-- Modal Tambah Dana DAK -->
<div id="modalTambahDanaDak"
    class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 items-center justify-center px-4 md:px-0">
    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Tambah Dana DAK</h3>
            <button onclick="closeModal('modalTambahDanaDak')" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
        <form action="{{ route('dana-dak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Masuk Surat</label>
                    <input type="date" name="tanggal_masuk" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sumber</label>
                    <input type="text" name="sumber" placeholder="Contoh: Internal Sekolah" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Foto Surat (opsional)</label>
                    <input type="file" name="foto"
                        class="w-full text-sm file:px-4 file:py-2 file:border-0 file:rounded-md file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeModal('modalTambahDanaDak')"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700 mr-2">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Dana DAK -->
<div id="editDanaDakModal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 items-center justify-center px-4 md:px-0">
    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Edit Dana DAK</h3>
            <button onclick="closeModal('editDanaDakModal')" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
        <form id="editDanaDakForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Masuk Surat</label>
                    <input type="date" name="tanggal_masuk" id="edit_tanggal_masuk_dak"
                        class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sumber</label>
                    <input type="text" name="sumber" id="edit_sumber_dak"
                        class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto"
                        class="w-full text-sm file:px-4 file:py-2 file:border-0 file:rounded-md file:bg-yellow-100 file:text-yellow-700 hover:file:bg-yellow-200">
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeModal('editDanaDakModal')"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700 mr-2">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded text-white">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Image -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
  <span onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-3xl cursor-pointer">&times;</span>
  <img id="modalImage" src="" class="max-w-full max-h-[90vh] rounded shadow-lg border-4 border-white">
</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
  }

  function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
  }

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

  function showFullImage(url) {
    document.getElementById('modalImage').src = url;
    openModal('imageModal');
  }

  function closeImageModal() {
    closeModal('imageModal');
  }

 function openEditDanaDakModal(dak) {
    document.getElementById('edit_tanggal_masuk_dak').value = dak.tanggal_masuk;
    document.getElementById('edit_sumber_dak').value = dak.sumber;

    const form = document.getElementById('editDanaDakForm');
    form.action = `/dana-dak/${dak.id}`;

    openModal('editDanaDakModal');
}

  // Cari berdasarkan tanggal
  document.getElementById('formCariTanggal').addEventListener('submit', function(e) {
    e.preventDefault();

    const tanggal = document.getElementById('tanggal').value;
    const hasilDiv = document.getElementById('hasilCariTanggal');
    const tbody = document.getElementById('hasilTanggalBody');

    if (!tanggal) return;

    fetch(`/dana-dak/cari?tanggal=${encodeURIComponent(tanggal)}`)
      .then(res => res.json())
      .then(data => {
        tbody.innerHTML = '';
        if (data.length === 0) {
          tbody.innerHTML = `<tr><td colspan="4" class="text-center text-gray-500 p-2">Tidak ada data</td></tr>`;
        } else {
          data.forEach((item, index) => {
            tbody.innerHTML += `
              <tr>
                <td class="p-2 border">${index + 1}</td>
                <td class="p-2 border">${item.tanggal_masuk}</td>
                <td class="p-2 border">${item.sumber}</td>
                <td class="p-2 border text-center">
                  ${item.foto
                    ? `<img src="/storage/dana_dak_foto/${item.foto}" class="h-12 cursor-pointer" onclick="showFullImage('/storage/dana_dak_foto/${item.foto}')">`
                    : '<span class="italic text-gray-400">Tidak ada</span>'}
                </td>
              </tr>
            `;
          });
        }

        hasilDiv.classList.remove('hidden');
      })
      .catch(err => console.error(err));
  });
</script>


</body>
</html>
