<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') | {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Platform digital untuk mengenal, mendokumentasikan, dan melestarikan budaya Sambas, Kalimantan Barat.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Lora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="theme-color" content="#12060A">
</head>
<body>
    <a class="skip-link" href="#konten">Lewati ke konten</a>

    <header class="header">
        <div class="kontainer header__bar">
            <a href="{{ route('home') }}" class="logo">WARISAKU <span>SAMBAS</span></a>

            <button type="button" class="nav-toggle" id="nav-toggle"
                    aria-controls="nav-utama" aria-expanded="false" aria-label="Buka menu navigasi">
                Menu
            </button>

            <nav class="nav" id="nav-utama" aria-label="Navigasi utama">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'aktif' : '' }}"
                   @if(request()->routeIs('home')) aria-current="page" @endif>Beranda</a>

                <a href="{{ route('budaya.index') }}"
                   class="{{ request()->routeIs('budaya.*') ? 'aktif' : '' }}"
                   @if(request()->routeIs('budaya.*')) aria-current="page" @endif>Jelajahi Budaya</a>

                {{-- Menu Kuis dan Suara Warisan ditambahkan saat halamannya selesai dibuat --}}
                <a href="{{ route('tentang') }}"
                   class="{{ request()->routeIs('tentang') ? 'aktif' : '' }}"
                   @if(request()->routeIs('tentang')) aria-current="page" @endif>Tentang</a>
            </nav>
        </div>
        <div class="ornamen" aria-hidden="true"></div>
    </header>

    <main id="konten">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="ornamen" aria-hidden="true"></div>
        <div class="kontainer">
            <div class="footer__grid">
                <div>
                    <h3>WARISAKU SAMBAS</h3>
                    <p>Platform digital untuk mengenal, mendokumentasikan, dan melestarikan budaya Sambas, Kalimantan Barat.</p>
                </div>
                <div>
                    <h3>Navigasi</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('budaya.index') }}">Jelajahi Budaya</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Informasi</h3>
                    <p>Setiap konten budaya dicantumkan bersama sumber rujukannya. Koreksi dan masukan dapat disampaikan kepada pengelola.</p>
                    <p>Kontak pengelola: (akan diisi)</p>
                </div>
            </div>
            <div class="footer__bawah">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Proyek mahasiswa Sistem Informasi.
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>