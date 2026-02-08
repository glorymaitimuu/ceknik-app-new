<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cek Peserta BPJS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="lg:min-h-screen bg-gradient-to-br from-slate-900 to-slate-800
           flex items-end sm:items-center justify-center
           px-3 py-6">

    <!-- CARD -->
    <div
        class="w-full max-w-lg
               bg-white rounded-2xl shadow-2xl
               p-6 sm:p-8 space-y-6">

        <!-- Header -->
        <div class="text-center space-y-1">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Cek Peserta BPJS
            </h1>
            <p class="text-sm sm:text-base text-slate-500">
                Masukkan NIK untuk melihat data
            </p>
        </div>

        <!-- Input -->
        <input
            id="nik"
            type="text"
            maxlength="16"
            placeholder="Masukkan NIK"
            class="w-full px-4 py-4 text-base sm:text-lg border rounded-xl
                   focus:ring-2 focus:ring-indigo-500 focus:outline-none">

        <!-- Button -->
        <button
            onclick="cekData()"
            class="w-full py-4 text-base sm:text-lg rounded-xl
                   bg-indigo-600 text-white font-semibold
                   hover:bg-indigo-700 transition
                   active:scale-[0.98]">
            Cari Data
        </button>

        <!-- Loading & Error -->
        <p id="loading" class="text-center text-sm text-gray-500 hidden">
            🔍 Memeriksa data...
        </p>
        <p id="error" class="text-center text-sm text-red-600 hidden"></p>

        <!-- RESULT -->
        <div id="result-card"
            class="hidden bg-slate-50 border rounded-xl p-5 space-y-5">

            <h2 class="font-semibold text-slate-800 text-lg text-center">
                Detail Kepesertaan
            </h2>

            <div class="grid grid-cols-1 gap-4 text-sm">
                <div>
                    <span class="text-slate-500">NIK</span>
                    <p id="r-nik" class="font-semibold"></p>
                </div>

                {{-- <div>
                    <span class="text-slate-500">KPJ</span>
                    <p id="r-kpj" class="font-semibold"></p>
                </div> --}}

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

                <!-- PROGRAM -->
                <div>
                    <span class="text-slate-500">Program Diikuti</span>
                    <div id="programs" class="flex flex-wrap gap-2 mt-2"></div>
                </div>
            </div>

            <div
                id="status"
                class="rounded-xl text-sm font-semibold text-center space-y-2 p-4">
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
            const programEl = document.getElementById('programs');

            const link = document.createElement('a');
            link.href = 'https://bpjsketenagakerjaan.go.id/bpu';
            link.target = '_blank';
            link.className = 'underline font-semibold';
            link.textContent = 'bpjsketenagakerjaan.go.id/bpu';

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
                    error.innerText =
                        'Anda tidak terdaftar sebagai peserta pekerja rentan Kabupaten Mimika';
                    error.classList.remove('hidden');
                    return;
                }

                const d = json.data;

                console.log(d);

                document.getElementById('r-nik').innerText = d.nik;
                // document.getElementById('r-kpj').innerText = d.kpj ?? '-';
                document.getElementById('r-nama').innerText = d.nama;
                document.getElementById('r-lahir').innerText = formatTanggal(d.tgl_lahir);
                document.getElementById('r-mulai').innerText = formatTanggal(d.tgl_kepesertaan);
                document.getElementById('r-akhir').innerText = formatTanggal(d.tgl_berakhir);

                // PROGRAM
                programEl.innerHTML = '';
                if (d.program) {
                    Object.entries(d.program).forEach(([key, val]) => {
                        if (val) {
                            const badge = document.createElement('span');
                            badge.className =
                                'px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold';
                            badge.textContent = key.toUpperCase();
                            programEl.appendChild(badge);
                        }
                    });
                }

                const today = new Date();
                const endDate = new Date(d.tgl_berakhir);

                statusEl.innerHTML = '';

                if (endDate < today) {
                    statusEl.className =
                        'rounded-xl text-sm font-semibold text-center p-4 bg-red-100 text-red-700';

                    statusEl.innerHTML =
                        '❌ Anda sudah tidak terdaftar sebagai pekerja rentan, silahkan daftar di ';
                    statusEl.appendChild(link);
                    statusEl.innerHTML +=
                        ' atau mengunjungi kantor kami di Jl. Cendrawasih SP2';
                } else {
                    statusEl.className =
                        'rounded-xl text-sm font-semibold text-center p-4 bg-green-100 text-green-700';

                    statusEl.innerHTML =
                        '✅ Kepesertaan Masih Aktif<br>' +
                        '<span class="text-xs font-normal">Berlaku sampai: ' +
                        formatTanggal(d.tgl_berakhir) +
                        '</span>';
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