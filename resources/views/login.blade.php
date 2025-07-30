<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Aset Sekolah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/logosmkn2.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col md:flex-row">

    <div class="w-full md:w-1/2 flex items-center justify-center bg-white px-6 py-12">
        <div class="w-full max-w-sm space-y-6">
            <div class="flex justify-center">
                <img src="{{ asset('img/logosmkn2.png') }}" alt="Logo SMKN 2" class="w-20 h-20 object-contain">
            </div>

            <h1 class="text-xl font-semibold text-gray-800 text-center">
                Aplikasi <span class="font-bold text-indigo-600">Inventaris Barang SMKN 2 KENDARI</span>
            </h1>

            @if(session('error'))
                <div class="text-red-500 text-sm text-center">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-700">ID</label>
                    <input type="text" name="nim" placeholder="Masukkan NIM..." required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Password</label>
                    <input type="password" name="password" placeholder="Masukkan kata sandi..." required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-500 text-white font-semibold rounded-md shadow hover:bg-indigo-600 transition">
                    Login
                </button>
            </form>

            <div class="pt-10 text-center">
                <p class="text-sm text-gray-600 mb-2">Kerja sama dengan:</p>
                <img src="{{ asset('img/stikom.png') }}" alt="Logo STIKOM" class="mx-auto w-20 h-auto opacity-90">
            </div>
        </div>
    </div>

    <div class="relative w-full md:w-1/2 h-64 md:h-auto">
        <img src="{{ asset('img/smkn2.jpeg') }}" alt="Foto Sekolah" class="w-full h-full object-cover">
        <div class="absolute bottom-0 left-0 p-4 md:p-6 bg-black bg-opacity-30 text-white">
            <h2 class="text-2xl md:text-4xl font-bold">Selamat datang kembali!</h2>
            <p class="text-sm md:text-md">SMKN 2 - Kendari</p>
            <p class="text-xs md:text-sm mt-2">Foto oleh Tim Dokumentasi Sekolah</p>
        </div>
    </div>

</body>
</html>
