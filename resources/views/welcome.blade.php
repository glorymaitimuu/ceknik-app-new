<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cek Peserta BPJS</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center p-4 sm:p-6">

    <div
        class="w-full max-w-xl bg-white rounded-2xl shadow-xl p-5 sm:p-8 space-y-5 sm:space-y-6">

        <!-- Header -->
        <div class="text-center">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Cek Peserta BPJS
            </h1>
            <p class="text-sm text-slate-500">
                Masukkan NIK untuk melihat data
            </p>
        </div>

        <!-- Input -->
        <input id="nik" type="text" maxlength="16" placeholder="Masukkan NIK"
            class="w-full px-4 py-3 text-sm sm:text-base border rounded-xl focus:ring-2 focus:ring-indigo-500">

        <!-- Button -->
        <button onclick="cekData()"
            class="w-full py-3 text-sm sm:text-base rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
            Cari Data
        </button>

        <!-- Loading & Error -->
        <p id="loading" class="mt-2 text-sm text-gray-500 hidden">
            🔍 Memeriksa data...
        </p>
        <p id="error" class="mt-2 text-sm text-red-600 hidden"></p>

        <!-- Result Card -->
        <div id="result-card"
            class="hidden bg-slate-50 border rounded-xl p-4 sm:p-6 space-y-4">

            <h2 class="font-semibold text-slate-800 text-base sm:text-lg">
                Detail Kepesertaan BPJS
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-sm">
                <div>
                    <span class="text-slate-500">NIK</span>
                    <p id="r-nik" class="font-medium"></p>
                </div>

                <div>
                    <span class="text-slate-500">KPJ</span>
                    <p id="r-kpj" class="font-medium"></p>
                </div>

                <div>
                    <span class="text-slate-500">Nama</span>
                    <p id="r-nama" class="font-medium"></p>
                </div>

                <div>
                    <span class="text-slate-500">Tanggal Lahir</span>
                    <p id="r-lahir" class="font-medium"></p>
                </div>

                <div>
                    <span class="text-slate-500">Tgl Kepesertaan</span>
                    <p id="r-mulai" class="font-medium"></p>
                </div>

                <div>
                    <span class="text-slate-500">Tgl Berakhir</span>
                    <p id="r-akhir" class="font-medium"></p>
                </div>
            </div>

            <!-- Status -->
            <div id="status"
                class="mt-4 px-3 sm:px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold text-center">
            </div>
        </div>

    </div>

    <script>
        async function cekData() {
            const nik = document.getElementById('nik').value.trim();
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');
            const card = document.getElementById('result-card');
            const statusEl = document.getElementById('status');

            error.classList.add('hidden');
            card.classList.add('hidden');
            loading.classList.remove('hidden');

            try {
                const res = await fetch('/api/cek-peserta-bpjs', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ nik })
                });

                const json = await res.json();
                loading.classList.add('hidden');

                if (!res.ok) {
                    error.innerText = json.message ?? 'Data tidak ditemukan';
                    error.classList.remove('hidden');
                    return;
                }

                const d = json.data;

                document.getElementById('r-nik').innerText = d.nik;
                document.getElementById('r-kpj').innerText = d.kpj ?? '-';
                document.getElementById('r-nama').innerText = d.nama;
                document.getElementById('r-lahir').innerText = formatTanggal(d.tgl_lahir);
                document.getElementById('r-mulai').innerText = formatTanggal(d.tgl_kepesertaan);
                document.getElementById('r-akhir').innerText = formatTanggal(d.tgl_berakhir);

                const today = new Date();
                const endDate = new Date(d.tgl_berakhir);

                if (endDate < today) {
                    statusEl.className =
                        'mt-4 px-3 sm:px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold text-center bg-red-100 text-red-700';
                    statusEl.innerText =
                        '❌ Kepesertaan Sudah Tidak Aktif. Silahkan Daftar Lagi!';
                } else {
                    statusEl.className =
                        'mt-4 px-3 sm:px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold text-center bg-green-100 text-green-700';
                    statusEl.innerText =
                        '✅ Kepesertaan Masih Aktif';
                }

                card.classList.remove('hidden');

            } catch (e) {
                loading.classList.add('hidden');
                error.innerText = 'Terjadi kesalahan sistem';
                error.classList.remove('hidden');
            }
        }

        function formatTanggal(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            return d.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }
    </script>

</body>

</html>
