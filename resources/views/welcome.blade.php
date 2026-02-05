<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cek Peserta BPJS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800
           flex items-end sm:items-center justify-center
           px-4 pb-10 sm:pb-0">

    <!-- CARD -->
    <div
        class="w-full max-w-none sm:max-w-xl
               min-h-[60vh] sm:min-h-0
               bg-white rounded-2xl shadow-2xl
               p-8 space-y-8">

        <!-- Header -->
        <div class="text-center space-y-2">
            <h1 class="text-3xl font-bold text-slate-800">
                Cek Peserta BPJS
            </h1>
            <p class="text-base text-slate-500">
                Masukkan NIK untuk melihat data
            </p>
        </div>

        <!-- Input -->
        <input
            id="nik"
            type="text"
            maxlength="16"
            placeholder="Masukkan NIK"
            class="w-full px-5 py-5 text-lg border rounded-xl
                   focus:ring-2 focus:ring-indigo-500
                   focus:outline-none">

        <!-- Button -->
        <button
            onclick="cekData()"
            class="w-full py-5 text-lg rounded-xl
                   bg-indigo-600 text-white font-semibold
                   hover:bg-indigo-700 transition
                   active:scale-[0.98]">
            Cari Data
        </button>

        <!-- Loading & Error -->
        <p id="loading" class="text-center text-base text-gray-500 hidden">
            🔍 Memeriksa data...
        </p>
        <p id="error" class="text-center text-base text-red-600 hidden"></p>

        <!-- RESULT -->
        <div id="result-card"
            class="hidden bg-slate-50 border rounded-xl p-6 space-y-6">

            <h2 class="font-semibold text-slate-800 text-xl text-center">
                Detail Kepesertaan
            </h2>

            <div class="grid grid-cols-1 gap-5 text-base">
                <div>
                    <span class="text-slate-500">NIK</span>
                    <p id="r-nik" class="font-semibold"></p>
                </div>

                <div>
                    <span class="text-slate-500">KPJ</span>
                    <p id="r-kpj" class="font-semibold"></p>
                </div>

                <div>
                    <span class="text-slate-500">Nama</span>
                    <p id="r-nama" class="font-semibold"></p>
                </div>

                <div>
                    <span class="text-slate-500">Tanggal Lahir</span>
                    <p id="r-lahir" class="font-semibold"></p>
                </div>

                <div>
                    <span class="text-slate-500">Tgl Kepesertaan</span>
                    <p id="r-mulai" class="font-semibold"></p>
                </div>

                <div>
                    <span class="text-slate-500">Tgl Berakhir</span>
                    <p id="r-akhir" class="font-semibold"></p>
                </div>
            </div>

            <div
                id="status"
                class="px-5 py-5 rounded-xl text-base font-semibold text-center">
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
                        'px-4 py-4 rounded-xl text-sm font-semibold text-center bg-red-100 text-red-700';
                    statusEl.innerText =
                        '❌ Kepesertaan Sudah Tidak Aktif. Silahkan Daftar Lagi!';
                } else {
                    statusEl.className =
                        'px-4 py-4 rounded-xl text-sm font-semibold text-center bg-green-100 text-green-700';
                    statusEl.innerText =
                        '✅ Kepesertaan Masih Aktif';
                }

                card.classList.remove('hidden');

            } catch {
                loading.classList.add('hidden');
                error.innerText = 'Terjadi kesalahan sistem';
                error.classList.remove('hidden');
            }
        }

        function formatTanggal(dateStr) {
            if (!dateStr) return '-';
            return new Date(dateStr).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }
    </script>

</body>

</html>
