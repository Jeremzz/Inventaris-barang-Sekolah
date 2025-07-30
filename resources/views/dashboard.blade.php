<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - SMKN 2 Kendari</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logosmkn2.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-gray-100 flex">

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

  <!-- Content Wrapper -->
  <div class="flex-1 flex flex-col">

<header class="bg-indigo-500 h-20 flex items-center justify-between px-6 text-white shadow z-10">
  <div class="flex items-center space-x-4">
    <span class="text-xl font-bold">Inventaris Barang Sekolah</span>
  </div>
  <div class="text-sm">Halo, Administrator</div>
</header>

  <main class="p-6 space-y-6">
  <!-- Cards Statistik -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <!-- Total Barang -->
    <div class="flex items-center bg-white rounded-xl shadow p-4 hover:shadow-md transition duration-300">
      <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 576 512">
          <path d="M248 0L208 0c-26.5 0-48 21.5-48 48l0 112c0 35.3 28.7 64 64 64l128 0c35.3 0 64-28.7 64-64l0-112c0-26.5-21.5-48-48-48L328 0l0 80c0 8.8-7.2 16-16 16l-48 0c-8.8 0-16-7.2-16-16l0-80zM64 256c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l160 0c35.3 0 64-28.7 64-64l0-128c0-35.3-28.7-64-64-64l-40 0 0 80c0 8.8-7.2 16-16 16l-48 0c-8.8 0-16-7.2-16-16l0-80-40 0zM352 512l160 0c35.3 0 64-28.7 64-64l0-128c0-35.3-28.7-64-64-64l-40 0 0 80c0 8.8-7.2 16-16 16l-48 0c-8.8 0-16-7.2-16-16l0-80-40 0c-15 0-28.8 5.1-39.7 13.8c4.9 10.4 7.7 22 7.7 34.2l0 160c0 12.2-2.8 23.8-7.7 34.2C323.2 506.9 337 512 352 512z"/>
        </svg>
      </div>
      <div>
        <p class="text-sm text-gray-500">Total Barang</p>
        <p class="text-xl font-bold text-indigo-600">{{ $totalBarang }}</p>
      </div>
    </div>

    <!-- Kondisi Baik -->
    <div class="flex items-center bg-white rounded-xl shadow p-4 hover:shadow-md transition duration-300">
      <div class="bg-green-100 text-green-600 p-3 rounded-full mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512">
          <path d="M50.7 58.5L0 160l208 0 0-128L93.7 32C75.5 32 58.9 42.3 50.7 58.5zM240 160l208 0L397.3 58.5C389.1 42.3 372.5 32 354.3 32L240 32l0 128zm208 32L0 192 0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-224z"/>
        </svg>
      </div>
      <div>
        <p class="text-sm text-gray-500">Kondisi Baik</p>
        <p class="text-xl font-bold text-green-600">{{ $totalBaik }}</p>
      </div>
    </div>

    <!-- Rusak Ringan -->
    <div class="flex items-center bg-white rounded-xl shadow p-4 hover:shadow-md transition duration-300">
      <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 576 512">
          <path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 160.4c0 35.3 28.7 64 64 64l102.3 0-31.3-52.2c-4.1-6.8-2.6-15.5 3.5-20.5L288 368l-60.2-82.8c-10.9-15 8.2-33.5 22.8-22l117.9 92.6c8 6.3 8.2 18.4 .4 24.9L288 448l38.4 64 122.1 0c35.5 0 64.2-28.8 64-64.3l-.7-160.2 32 0z"/>
        </svg>
      </div>
      <div>
        <p class="text-sm text-gray-500">Rusak Ringan</p>
        <p class="text-xl font-bold text-yellow-600">{{ $totalRingan }}</p>
      </div>
    </div>

    <!-- Rusak Berat -->
    <div class="flex items-center bg-white rounded-xl shadow p-4 hover:shadow-md transition duration-300">
      <div class="bg-red-100 text-red-600 p-3 rounded-full mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 576 512">
          <path d="M499.6 11.3c6.7-10.7 20.5-14.5 31.7-8.5s15.8 19.5 10.6 31L404.8 338.6c2.2 2.3 4.3 4.7 6.3 7.1l97.2-54.7c10.5-5.9 23.6-3.1 30.9 6.4s6.3 23-2.2 31.5l-87 87-71.4 0c-13.2-37.3-48.7-64-90.5-64s-77.4 26.7-90.5 64l-79.6 0L42.3 363.7c-9.7-6.7-13.1-19.6-7.9-30.3s17.4-15.9 28.7-12.4l97.2 30.4c3-3.9 6.1-7.7 9.4-11.3L107.4 236.3c-6.1-10.1-3.9-23.1 5.1-30.7s22.2-7.5 31.1 .1L246 293.6c1.5-.4 3-.8 4.5-1.1l13.6-142.7c1.2-12.3 11.5-21.7 23.9-21.7s22.7 9.4 23.9 21.7l13.5 141.9L499.6 11.3zM64 448s0 0 0 0l448 0s0 0 0 0l32 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 512c-17.7 0-32-14.3-32-32s14.3-32 32-32l32 0zM288 0c13.3 0 24 10.7 24 24l0 48c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-48c0-13.3 10.7-24 24-24z"/>
        </svg>
      </div>
      <div>
        <p class="text-sm text-gray-500">Rusak Berat</p>
        <p class="text-xl font-bold text-red-600">{{ $totalBerat }}</p>
      </div>
    </div>
</div>
  <!-- Grafik -->
  <div class="bg-white rounded-xl shadow p-6 mt-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Inventaris</h2>
    <canvas id="grafikInventaris" class="w-full max-w-md mx-auto"></canvas>
  </div>
</main>


  <script>
  const ctx = document.getElementById('grafikInventaris').getContext('2d');

  const chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Kondisi Baik', 'Rusak Ringan', 'Rusak Berat'],
      datasets: [{
        label: 'Kondisi Barang',
        data: [{{ $totalBaik }}, {{ $totalRingan }}, {{ $totalBerat }}],
        backgroundColor: [
          'rgb(34,197,94)',     // green-500
          'rgb(234,179,8)',     // yellow-500
          'rgb(239,68,68)',     // red-500
        ],
        borderColor: 'white',
        borderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#374151', // text-gray-700
            font: {
              size: 14,
              family: 'sans-serif'
            }
          }
        }
      }
    }
  });
</script>
<footer class="bg-gray-800 text-gray-300 py-6 mt-12 text-center text-sm">
    <p class="mb-1">
        Website kerjasama <strong>STIKOM</strong> & <strong>SMKN 2 Kendari</strong> — Sistem Informasi Inventaris Aset Sekolah.
    </p>
    <p>
        &copy; {{ date('Y') }} All rights reserved.
    </p>
</footer>
</body>
</html>
