
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pendanaan Siswa - SMKN 2 Kendari</title>
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
      <a href="/dana-dak" class="block py-2 px-4 rounded hover:bg-indigo-100 text-gray-700 font-medium">Dana DAK</a>
      <a href="/pendanaan-siswa" class="block py-2 px-4 rounded bg-indigo-100 text-indigo-700 font-semibold">Pendanaan Siswa</a>
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
        <span class="text-xl font-bold">Pendanaan Siswa</span>
        <span class="text-sm">Halo, Administrator</span>
        </header>

        <main class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Manajemen Pendanaan Siswa</h2>
            <button onclick="openModal('modalTambahPendanaan')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm shadow font-medium">+ Tambah Data</button>
        </div>
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="text-sm list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="overflow-x-auto bg-white shadow rounded-lg border border-gray-200">
            <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
                <tr>
                <th class="px-4 py-3 text-center">No</th>
                <th class="px-4 py-3 text-center">Nama Siswa</th>
                <th class="px-4 py-3 text-center">NIS</th>
                <th class="px-4 py-3 text-center">Kelas</th>
                <th class="px-4 py-3 text-center">Jenis Pendanaan</th>
                <th class="px-4 py-3 text-center">Tanggal</th>
                <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 divide-y">
                @forelse ($pendanaan as $index => $data)
                <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-3 text-center">{{ $data->nama_siswa }}</td>
                <td class="px-4 py-3 text-center">{{ $data->nis }}</td>
                <td class="px-4 py-3 text-center">{{ $data->kelas }}</td>
                <td class="px-4 py-3 text-center">{{ $data->jenis_pendanaan }}</td>
                <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                <td class="px-4 py-3 text-center">
    <div class="flex justify-center items-center space-x-2">
        <a href="{{ route('pendanaan-siswa.show', $data->id) }}"
        class="text-blue-600 hover:underline text-xs flex items-center space-x-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Detail</span>
        </a>
        <button onclick="openEditModal({{ $data }})"
            class="text-yellow-600 hover:underline text-xs flex items-center space-x-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 512 512" fill="currentColor">
            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7z"/>
        </svg>
        </button>
        <button onclick="openDeleteModal({{ $data->id }})"
            class="text-red-600 hover:underline text-xs flex items-center space-x-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512" fill="currentColor">
            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
        </svg>
        </button>
    </div>
    </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-4 text-gray-500">Belum ada data pendanaan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Modal Tambah Pendanaan -->
<div id="modalTambahPendanaan" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 items-center justify-center px-4 md:px-0">
  <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold text-gray-800">Tambah Pendanaan Siswa</h3>
      <button onclick="closeModal('modalTambahPendanaan')" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
    </div>
    <form action="{{ route('pendanaan-siswa.store') }}" method="POST">
      @csrf
      <div class="space-y-4">
        <input type="text" name="nama_siswa" placeholder="Nama Siswa" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="text" name="nis" placeholder="NIS" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="text" name="kelas" placeholder="Kelas" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="text" name="jenis_pendanaan" placeholder="Jenis Pendanaan" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
      </div>
      <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeModal('modalTambahPendanaan')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700 mr-2">Batal</button>
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded text-white">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Pendanaan -->
<div id="modalEditPendanaan" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 items-center justify-center px-4 md:px-0">
  <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold text-gray-800">Edit Pendanaan Siswa</h3>
      <button onclick="closeModal('modalEditPendanaan')" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
    </div>
    <form id="formEditPendanaan" method="POST">
      @csrf
      @method('PUT')
      <div class="space-y-4">
        <input type="text" name="nama_siswa" id="edit_nama_siswa" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="text" name="nis" id="edit_nis" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="text" name="kelas" id="edit_kelas" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="text" name="jenis_pendanaan" id="edit_jenis_pendanaan" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        <input type="date" name="tanggal" id="edit_tanggal" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
      </div>
      <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeModal('modalEditPendanaan')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700 mr-2">Batal</button>
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded text-white">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Hapus -->
<div id="modalDelete" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 items-center justify-center px-4 md:px-0">
  <div class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 text-center">
    <h3 class="text-lg font-semibold mb-4 text-gray-800">Konfirmasi Hapus</h3>
    <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
    <form id="formDeletePendanaan" method="POST">
      @csrf
      @method('DELETE')
      <div class="flex justify-center space-x-4">
        <button type="button" onclick="closeModal('modalDelete')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700">Batal</button>
        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Hapus</button>
      </div>
    </form>
  </div>
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

// Fungsi untuk isi modal edit
function openEditModal(data) {
  openModal('modalEditPendanaan');
  document.getElementById('edit_nama_siswa').value = data.nama_siswa;
  document.getElementById('edit_nis').value = data.nis;
  document.getElementById('edit_kelas').value = data.kelas;
  document.getElementById('edit_jenis_pendanaan').value = data.jenis_pendanaan;
  document.getElementById('edit_tanggal').value = data.tanggal;

  const form = document.getElementById('formEditPendanaan');
  form.action = `/pendanaan-siswa/${data.id}`;
}

// Fungsi untuk isi modal hapus
function openDeleteModal(id) {
  openModal('modalDelete');
  const form = document.getElementById('formDeletePendanaan');
  form.action = `/pendanaan-siswa/${id}`;
}
</script>


</body>
</html>
