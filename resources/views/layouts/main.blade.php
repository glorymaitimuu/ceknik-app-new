<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Pekerja Rentan Mimika - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Outfit:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        .font-logo {
            font-family: 'Fredoka One', cursive;
        }

        .font-main {
            font-family: 'Outfit', sans-serif;
        }
    </style>
    @stack('style')
</head>

<body class="bg-white font-main min-h-screen flex flex-col">

    <!-- Header -->
    <header class="p-6 md:px-12 flex justify-between items-center bg-white shadow-sm">
        <!-- Brand Logo -->
        <div class="flex flex-col">
            <h1 class="font-logo text-4xl text-[#F5C400] leading-tight tracking-wide">PORTAL</h1>
            <p class="text-[10px] md:text-xs font-bold text-[#16A34A] tracking-[0.15em] -mt-1 uppercase">PEKERJA RENTAN
                MIMIKA</p>
            @if (!request()->is('/'))
                <a href="/"
                    class="flex items-center gap-2 mt-4 text-gray-400 hover:text-gray-600 transition w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-[18px] font-black uppercase tracking-widest">Kembali</span>
                </a>
            @endif
        </div>

        <!-- BPJS Logo -->
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="BPJS Ketenagakerjaan Logo" class="h-16 md:h-24 object-contain">
        </div>
    </header>

    @yield('content')

    <!-- Footer Decoration -->
    <footer class="py-8 opacity-50 text-center text-xs text-gray-400">
        &copy; 2024 BPJS Ketenagakerjaan Papua Mimika
    </footer>

    @stack('script')
</body>

</html>
