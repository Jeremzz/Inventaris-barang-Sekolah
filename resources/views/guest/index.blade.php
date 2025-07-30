<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Negeri 2 Kendari</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
@keyframes zoom {
    from {
        transform: scale(0.7);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
.animate-zoom {
    animation: zoom 0.3s ease-out;
}
</style>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">
<main class="flex-1">
    <div class="bg-indigo-400 text-white flex items-center px-6 py-3 shadow">
        <img src="{{ asset('img/logosmkn2.png') }}" alt="Logo SMKN 2 Kendari" class="w-16 h-16 mr-4">
        <div>
            <h1 class="text-xl font-bold">SMK NEGERI 2 KENDARI</h1>
            <p class="text-sm">Upgrade skill dan siap bersaing pada dunia kerja</p>
        </div>
    </div>
    <section class="relative h-[300px] bg-cover bg-center" style="background-image: url('{{ asset('img/asset.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center px-4">
            <h2 class="text-2xl md:text-4xl font-bold text-white mb-2">SMK Negeri 2 Kendari</h2>
            <p class="text-white text-lg">Jl. Jend. Ahmad Yani, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93117</p>
        </div>
    </section>
    <section class="py-10 px-4 max-w-4xl mx-auto">
        <div class="text-center mb-6">
            <p class="text-gray-600">Cari Barang di SMK Negeri 2 Kendari</p>
        </div>
        <form id="searchForm" class="flex flex-col sm:flex-row justify-center mb-6">
            <input type="text" id="searchInput" name="query" placeholder="Cari barang..."
                class="w-full max-w-md px-4 py-2 border rounded-md sm:rounded-l-md sm:rounded-r-none mb-3 sm:mb-0">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-r-md hover:bg-red-700 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white" class="w-5 h-5">
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8
                    12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0
                    208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                </svg>
            </button>
        </form>
        <div id="searchResults" class="mt-4 space-y-4 text-gray-800">
        </div>
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden transition-opacity duration-300">
            <div class="relative animate-zoom">
                <img id="modalImage" class="max-h-[90vh] w-auto max-w-full rounded shadow-lg border-4 border-white" alt="Preview Gambar">
                <button onclick="closeModal()" class="absolute top-2 right-2 text-white bg-red-600 hover:bg-red-700 p-1 rounded-full text-xl">&times;</button>
            </div>
        </div>
    </section>
    </main>
    <script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const query = document.getElementById('searchInput').value;
        fetch(`/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('searchResults');
                resultsContainer.innerHTML = '';
                if (data.length === 0) {
                    resultsContainer.innerHTML = '<p class="text-center text-gray-500">Tidak ada hasil ditemukan.</p>';
                } else {
                    data.forEach(item => {
                        let imgUrl = null;
                        if (item.foto) {
                            if (item.sumber_tabel === 'barangs') {
                                imgUrl = `/storage/barang_fotos/${item.foto}`;
                            } else if (item.sumber_tabel === 'dana_bos') {
                                imgUrl = `/storage/dana_bos_foto/${item.foto}`;
                            } else if (item.sumber_tabel === 'dana_daks') {
                                imgUrl = `/storage/dana_dak_foto/${item.foto}`;
                            } else if (item.sumber_tabel === 'pendanaan_siswa') {
                                imgUrl = `/storage/foto_penggunaan_siswa/${item.foto}`;
                            }
                        }

                        resultsContainer.innerHTML += `
                        <div class="bg-white border border-gray-300 rounded-xl shadow-md flex flex-col md:flex-row items-center p-6 gap-6 hover:shadow-lg transition">
                            ${imgUrl ? `<img src="${imgUrl}" class="w-36 h-36 object-cover rounded-md border cursor-pointer" onclick="openModal('${imgUrl}')">` : ''}
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3 border-b pb-2 border-dashed border-gray-300">${item.nama_barang ?? '(Tidak ada nama barang)'}</h3>
                                <dl class="text-base text-gray-700 grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-6">
                                    ${item.kode_seri ? `<div><dt class="font-medium">Kode Seri:</dt><dd>${item.kode_seri}</dd></div>` : ''}
                                    ${item.tahun_pengadaan ? `<div><dt class="font-medium">Tahun Pengadaan:</dt><dd>${item.tahun_pengadaan}</dd></div>` : ''}
                                    ${item.kondisi ? `<div><dt class="font-medium">Kondisi:</dt><dd>${item.kondisi}</dd></div>` : ''}
                                    ${item.tanggal_masuk ? `<div><dt class="font-medium">Tanggal Masuk:</dt><dd>${item.tanggal_masuk}</dd></div>` : ''}
                                    ${item.sumber ? `<div><dt class="font-medium">Sumber:</dt><dd>${item.sumber}</dd></div>` : ''}
                                    ${item.nama_siswa ? `<div><dt class="font-medium">Nama Siswa:</dt><dd>${item.nama_siswa}</dd></div>` : ''}
                                    ${item.nis ? `<div><dt class="font-medium">NIS:</dt><dd>${item.nis}</dd></div>` : ''}
                                    ${item.kelas ? `<div><dt class="font-medium">Kelas:</dt><dd>${item.kelas}</dd></div>` : ''}
                                    ${item.nama_jurusan ? `<div><dt class="font-medium">Jurusan:</dt><dd>${item.nama_jurusan}</dd></div>` : ''}
                                    ${item.jumlah ? `<div><dt class="font-medium">Jumlah:</dt><dd>${item.jumlah}</dd></div>` : ''}
                                    ${item.harga_satuan ? `<div><dt class="font-medium">Harga Satuan:</dt><dd>Rp ${item.harga_satuan.toLocaleString()}</dd></div>` : ''}
                                    ${item.total_harga ? `<div><dt class="font-medium">Total Harga:</dt><dd>Rp ${item.total_harga.toLocaleString()}</dd></div>` : ''}
                                </dl>
                            </div>
                        </div>
                        `;
                    });
                }
            })
            .catch(error => {
                console.error('Gagal memuat hasil:', error);
                const resultsContainer = document.getElementById('searchResults');
                resultsContainer.innerHTML = '<p class="text-center text-red-600">Terjadi kesalahan saat memuat data.</p>';
            });
        });
        function openModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
        }
        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target.id === 'imageModal') {
                closeModal();
            }
        });
    </script>
    <footer class="bg-gray-800 text-gray-300 py-6 mt-12 text-center text-sm">
    <p class="mb-1">
        Website kerjasama <strong>STIKOM</strong> &amp; <strong>SMKN 2 Kendari</strong> — Sistem Informasi Inventaris Aset Sekolah.
    </p>
    <p>
        &copy; {{ date('Y') }} All rights reserved.
    </p>
</footer>
</body>
</html>
